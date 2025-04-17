<?php 
include ('components/connect.php');

session_start();
if (isset($_SESSION['usuarioId'] ) && isset($_SESSION['nivel_de_acesso'])){
  $user_id = $_SESSION['usuarioId']; 
  $nivel_acesso = $_SESSION['nivel_de_acesso'];
}else{
  $user_id = '';
  $nivel_acesso= '';
  header('location:login.php');

}

if (isset($_GET['get_id'])){
  $get_id = $_GET['get_id'];

}else{
  $get_id = '';
  header('location:home.php');
}


include ('components/save_send.php');
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

      <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
/>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->

    <title>VISUALIZACAO</title>
</head>

   

<body> 
<?php include ('components/user_header.php'); ?>

  <section class="view-property">
   
    <?php
    $select_property = $conn-> prepare("SELECT * FROM `property` WHERE 
    id = ? LIMIT 1");
    $select_property->execute([$get_id]);
    if($select_property -> rowCount() > 0 ){
      while($fetch_property = $select_property ->fetch(PDO::FETCH_ASSOC)){
        $property_id = $fetch_property['id'];

        $select_user = $conn-> prepare("SELECT * FROM `users` WHERE 
        id = ? LIMIT 1");
        $select_user->execute([$fetch_property['user_id']]);
        $fetch_user = $select_user ->fetch(PDO::FETCH_ASSOC);

        $select_saved = $conn-> prepare("SELECT * FROM `saved` WHERE 
        property_id = ? AND user_id = ?");
        $select_saved->execute([$property_id, $user_id]);
    
    ?> 

    <div class="details">
      <div class="swiper images-container">
        <div class="swiper-wrapper">
          <img src="uploaded_files/<?=$fetch_property['img1'];?>" 
          alt="" class= "swiper-slide">
          <?php if (!empty($fetch_property['img2'])){
            echo '<img src="uploaded_files/'.$fetch_property['img2'].'" class="swiper-slide" alt="">';
          }?>

            <?php if (!empty($fetch_property['img3'])){
            echo '<img src="uploaded_files/'.$fetch_property['img3'].'" class="swiper-slide" alt="">';
          }?>

            <?php if (!empty($fetch_property['img4'])){
            echo '<img src="uploaded_files/'.$fetch_property['img4'].'" class="swiper-slide" alt="">';
          }?>

            <?php if (!empty($fetch_property['img5'])){
            echo '<img src="uploaded_files/'.$fetch_property['img5'].'" class="swiper-slide" alt="">';
          }?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
      <h3 class="name"><?=$fetch_property['nome_imovel'];?></h3>
      <p class="address"><i class="fas fa-map-marker-alt"></i><span>
        <?=$fetch_property['localizacao'];?></span></p>

        <div class="info">
          <p><i>$</i><span><?=$fetch_property['preco'];?></span></p>

          <p><i class='fas fa-user'></i><span><?=$fetch_user['nome'];?></span></p>

          <p><i class="fas fa-phone"></i><a href="tel:<?=$fetch_user['number'];?>"><?=$fetch_user['number'];?></a></p>

          
          <p><i class='fas fa-building'></i><span><?=$fetch_property['service'];?></span></p>

          
          <p><i class='fas fa-house'></i><span><?=$fetch_property['tipo_de_imovel'];?></span></p>

          
          <p><i class='fas fa-calendar'></i><span><?=$fetch_property['data'];?></span></p>

        </div>
        <h3 class="title">detalhes </h3>
        <div class="flex">
          <div class="box">
            <p><i>tamanhos :</i> <span><?=$fetch_property['tamanho'];?></span></p>
            <p><i>quartos :</i><span><?=$fetch_property['quartos'];?></span></p>
            <p><i>banheiros :</i><span><?=$fetch_property['banheiros'];?></span></p>
            <p><i>garragem :</i><span><?=$fetch_property['garragem'];?></span></p>
            <p><i>estado :</i><span><?=$fetch_property['status'];?></span></p>
          </div>


        </div>
        <h3 class="title">amenities</h3>
        <div class="flex">
          <div class="box">
          <p><i class="fas fa-<?php if ($fetch_property['varanda'] == 'yes')
          {echo'check';}else{echo'times';}?>"></i> <span>varanda</span></p>

          <p><i class="fas fa-<?php if ($fetch_property['terraco'] == 'yes')
                    {echo'check';}else{echo'times';}?>"></i> <span>terraco</span></p>

<p><i class="fas fa-<?php if ($fetch_property['escritorio'] == 'yes')
          {echo'check';}else{echo'times';}?>"></i> <span>escritorio</span></p>

<p><i class="fas fa-<?php if ($fetch_property['piscina'] == 'yes')
          {echo'check';}else{echo'times';}?>"></i> <span>piscina</span></p>

<p><i class="fas fa-<?php if ($fetch_property['churrasqueira'] == 'yes')
          {echo'check';}else{echo'times';}?>"></i> <span>churrasqueira</span></p>


<p><i class="fas fa-<?php if ($fetch_property['salao_de_festas'] == 'yes')
          {echo'check';}else{echo'times';}?>"></i> <span>salao de festas</span></p>


          </div>
          </div>

          <h3 class="title">descricao</h3>
          <p class="description"><?=$fetch_property['descricao'];?></p>
          <form action="" method="POST">
            <input type="hidden" name="property_id" value = "<?=$property_id;?>">
       <div class="flex-btn">
          <?php  if ($select_saved->rowCount() > 0){?>

      <button type="submit" name="save" class="save"><i class="fas fa-heart"></i><span>salvado</span></button>

      <?php }else{?>
      <button type="submit" name="save" class="save"><i class="far fa-heart"></i><span>salvar</span></button>

      <?php }?>
      <input type="submit" value="solicitar" name="send" class="btnc">
            </div>
          </form>
        </div>

    </div>

    <?php

         }

    }else{
      echo '<p clas="empty"> Imovel nao  encontrado</p>';

    }
    
    ?>
   
   
  </section>

<?php include ('components/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script src="js/restrita.js"></script>

    <?php include ('components/message.php'); ?>

    <script>
    var swiper = new Swiper(".images-container", {
      loop:true,
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 200,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
      },
    });
  </script>
    
</body>

</html>
