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


include ('components/save_send.php');

if(isset($_POST['delete'])){
  $delete_id =$_POST['request_id'];
  $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
  $verify_delete= $conn->prepare('SELECT * FROM `requests` WHERE id = ?');
  $verify_delete->execute([$delete_id]);

  if($verify_delete->rowCount () > 0){
    $delete_request = $conn->prepare('DELETE FROM `requests` 
    WHERE id = ? ');
    $delete_request->execute([$delete_id]);
    $sucess_msg[] = 'Solicitação apagada';
  }else{

    $warning_msg[] = 'Solicitação ja foi apagada';

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
  <title>Document</title>
</head>
<body>

<?php include ('components/user_header.php'); ?>


<section class="requests">
  <h1 class="heading">Solitações recebidas</h1>
  <div class="box-container">

    <?php 
    $select_requests = $conn ->prepare("SELECT * FROM `requests` WHERE
    receiver = ? ORDER BY data DESC");
    $select_requests ->execute([$user_id]);
    if ($select_requests->rowCount () > 0){
      while($fetch_requests = $select_requests ->fetch(PDO::FETCH_ASSOC)){
        
        $select_sender = $conn ->prepare("SELECT * FROM `users` WHERE
        id = ? ");
        $select_sender ->execute([$fetch_requests['sender']]);
        $fetch_sender = $select_sender ->fetch(PDO::FETCH_ASSOC);

        $select_proprety = $conn ->prepare("SELECT * FROM `property` WHERE
        id = ? ");
        $select_proprety->execute([$fetch_requests['property_id']]);
        $fetch_property = $select_proprety ->fetch(PDO::FETCH_ASSOC);
      

    ?>

    <div class="box">
      <p>Nome : <span><?=$fetch_sender['nome'];?></span></p>
      <p>Telefone : <a href="tel:<?=$fetch_sender['number'];?>">
      <?=$fetch_sender['number'];?></a></p>
      <p>Email : <a href="tel:<?=$fetch_sender['email'];?>">
      <?=$fetch_sender['email'];?></a></p>
      <p>Solicitou por :<a href="view_propried.php?get_id=
      <?=$fetch_property['id'];?>"><?=$fetch_property['nome_imovel'];?></a></p>
      <form action="" method="POST">
        <input type="hidden" name="request_id"
         value="<?=$fetch_requests['id'];?> ">

         <input type="submit" value="apagar solicitação" class="btnc" 
         name="delete" onclick="return confirm('Apagar esta solicitação?');">

      </form>
      </div> 
    

    <?php
    }
    
  }else{
    echo '<p class="empty"> Voce não tem nenhuma solicitação</p>';
  }
  
    
    ?>
    

  

  </div>

</section>

  
 <?php include ('components/footer.php'); ?>


<script src="js/script.js"></script>
<?php include ('components/message.php'); ?>
    
</body>
</html>