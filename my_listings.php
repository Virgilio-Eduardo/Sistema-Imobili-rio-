<?php 
include ('components/connect.php');

session_start();
if (isset($_SESSION['usuarioId'] ) && isset($_SESSION['nivel_de_acesso'])){
  $user_id = $_SESSION['usuarioId']; 
  $nivel_acesso = $_SESSION['nivel_de_acesso'];
}else{
  $user_id = '';
  $nivel_acesso= '';
}
if (isset($_POST['delete'])){

  $delete_id = $_POST['property_id'];
  $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

  $verify_delete= $conn->prepare('SELECT * FROM `property` WHERE id = ?');
  $verify_delete->execute([$delete_id]);

  if ($verify_delete ->rowCount() > 0){
    $select_images = $conn ->prepare('SELECT * FROM `property` 
    WHERE id = ? LIMIT 1');
    $select_images ->execute([$delete_id]);
    $fetch_images = $select_images ->fetch(PDO::FETCH_ASSOC);
    $delete_img1 = $fetch_images['img1'];
    $delete_img2 = $fetch_images['img2'];
    $delete_img3 = $fetch_images['img3'];
    $delete_img4 = $fetch_images['img4'];
    $delete_img5 = $fetch_images['img5'];

    unlink('uploaded_files/'.$delete_img1);

    if (!empty($delete_img2)){
      unlink('uploaded_files/'.$delete_img2);

    }

    if (!empty($delete_img3)){
      unlink('uploaded_files/'.$delete_img3);

    }

    if (!empty($delete_img4)){
      unlink('uploaded_files/'.$delete_img4);

    }

    if (!empty($delete_img5)){
      unlink('uploaded_files/'.$delete_img5);

    }

    $delete_saved = $conn->prepare('DELETE FROM `saved` 
    WHERE property_id = ? ');
    $delete_saved->execute([$delete_id]);

    $delete_requests = $conn->prepare('DELETE FROM `requests` 
    WHERE property_id = ? ');
    $delete_requests->execute([$delete_id]);

    $delete_listing = $conn->prepare('DELETE FROM `property` 
    WHERE id = ? ');
    $delete_listing->execute([$delete_id]);
    $sucess_msg[] = 'Publicação apagada';



  }else{
    $warning_msg[] ='Publicação já deletado';
  }


}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="restrita/restrita.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
  <title>Minha Listas</title>
</head>
<body>

<?php include ('components/user_header.php'); ?>

<section class="my-listings">
  <h1 class="heading">Minhas publicações</h1>

  <div class="box-container">
   <?php

   $select_listing = $conn->prepare("SELECT * FROM `property`
    WHERE user_id=? ORDER BY data DESC ");
    $select_listing->execute([$user_id]);

    if ($select_listing->rowCount() > 0){
      while($fetch_listing = $select_listing->fetch(PDO::FETCH_ASSOC)){
          
     $listing_id = $fetch_listing['id']; 

     if(!empty($fetch_listing['img2'])){
      $img2 = 1;
     } else{
      $img2 = 0;
     }

     if(!empty($fetch_listing['img3'])){
      $img3 = 1;
     } else{
      $img3 = 0;
     }

     if(!empty($fetch_listing['img4'])){
      $img4 = 1;
     } else{
      $img4 = 0;
     }

     if(!empty($fetch_listing['img5'])){
      $img5 = 1;
     } else{
      $img5 = 0;
     }

     $total_img =(1 + $img2 + $img3 + $img4 + $img5);

   ?>

   <form action="" method="POST" class="box">
    <input type="hidden" name="property_id" value="<?= $listing_id;?>">
    <div class="thumb">
      <p><i class="far fa-image"></i><span><?= $total_img; ?></span></p>
      <img src="uploaded_files/<?=$fetch_listing['img1'];?>" alt="">
    
    </div>

    <div class="price"><i class="fas fa-indian
    -rupee-sign"></i><?= $fetch_listing['preco'];?><span>mzn</span></div>

    <div class="name"><?= $fetch_listing['nome_imovel'];?></div>

    <div class="address"><i class="fas fa-map-marker-alt">
    </i><?= $fetch_listing['localizacao'];?></div>

    <div class="flex-btn">
      <a href="update_imovel.php?get_id=<?=$listing_id;?>" class="btnc">Atualizar</a>
      <input type="submit" value="Apagar"  class="btnA" name ="delete" onclick="return confirm('Apagar está publicação?');" >

    </div>

    <div class="flex-btn1">
       <a href="view_propried.php?get_id=<?=$listing_id;?>" class="btnc">Visualizar imovel</a>
    </div>

   </form>
 
   <?php 
  }

  

}else{
  echo'<p class="empty">Nenhuma publicação encontrada</p>';
} 

   
   ?>

  </div>

</section>

  <?php include ('components/footer.php'); ?>


    <script src="js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
    
<?php include ('components/message.php'); ?>

    
</body>
</html>