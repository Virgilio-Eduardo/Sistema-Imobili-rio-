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

<section class="dashboard">
  <h1 class="heading">Painel</h1>
  <div class="box-container">
   <div class="box">
    <?php
    $select_user = $conn-> prepare("SELECT * FROM `users` WHERE id = ?
    LIMIT 1");
    $select_user->execute([$user_id]);
    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

    ?>

    <h3>Bem-Vindo</h3>
    <p><?= $fetch_user['nome'];?></p>
    <a href="update.php" class="btnc">Atualizar</a>
   </div>

   <div class="box">
    

    <h3>Filtro de pesquisa</h3>
    <p>Procure a sua casa dos sonhos</p>
    <a href="search.php" class="btnc">Pesquisar</a>
   </div>

   <div class="box">
    <?php 
    $count_listings = $conn -> prepare("SELECT * FROM `property`
     WHERE user_id = ?");
     $count_listings ->execute([$user_id]);
     $fetch_total_listing = $count_listings->rowCount();

    ?>

    <h3><?=$fetch_total_listing;?></h3>
    <p>Imoveis publicados</p>
    <a href="my_listings.php" class="btnc">Visualizar</a>

   </div>

   <div class="box">
    <?php 
    $count_request_received = $conn -> prepare("SELECT * FROM `requests`
     WHERE receiver = ?");
     $count_request_received ->execute([$user_id]);
     $fetch_total_request = $count_request_received->rowCount();

    ?>

    <h3><?=$fetch_total_request;?></h3>
    <p>Solitações recebidas</p>
    <a href="request.php" class="btnc">Visualizar</a>

   </div>

   <div class="box">
    <?php 
    $count_resquest_sender = $conn -> prepare("SELECT * FROM `requests`
     WHERE sender = ?");
     $count_resquest_sender ->execute([$user_id]);
     $fetch_total_request = $count_resquest_sender->rowCount();

    ?>

    <h3><?=$fetch_total_request;?></h3>
    <p>Solitações enviadas</p>
    <a href="saved.php" class="btnc">Visualizar</a>

   </div>

   <div class="box">
    <?php 
    $count_saved = $conn -> prepare("SELECT * FROM `saved`
     WHERE user_id = ?");
     $count_saved ->execute([$user_id]);
     $fetch_total_saved = $count_saved->rowCount();

    ?>

    <h3><?=$fetch_total_saved;?></h3>
    <p>Imoveis salvados</p>
    <a href="saved.php" class="btnc">Visualizar</a>

   </div>
  </div>

</section>

  
 <?php include ('components/footer.php'); ?>


    <script src="js/script.js"></script>

    <?php include ('components/message.php'); ?>  
</body>
</html>