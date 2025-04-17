<?php 
include ('components/connect.php');

session_start();
if (isset($_SESSION['usuarioId'] ) && isset($_SESSION['nivel_de_acesso'])){
  $admin_id = $_SESSION['usuarioId']; 
  $nivel_acesso = $_SESSION['nivel_de_acesso'];
}else{
  $user_id = '';
  $nivel_acesso= '';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="restrita/admin_style.css" rel="stylesheet"> 
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
      />
    <title>Admin</title>
</head>


<body>

<?php include('components/admin_header.php'); ?>


<section class="dashboard">
  <h1 class="heading"> Painel</h1>
  <div class="box-container">
    <div class="box">
      <?php 
      $selecionar_prefil = $conn ->prepare("SELECT * FROM `users` WHERE 
      id = ? ");
      $selecionar_prefil ->execute([$admin_id]);
      $buscar_prefil = $selecionar_prefil ->fetch(PDO::FETCH_ASSOC);
      
      ?>
      <h3>Bem-vindo</h3>
      <p><?=$buscar_prefil['nome'];?></p>
      <a href="update.php" class="btn">Atualizar perfil</a>
    </div>

    <div class="box">
      <?php 
      $selecionar_listings= $conn ->prepare("SELECT * FROM `property`  ");
      $selecionar_listings ->execute();
      $buscar_total_listings = $selecionar_listings ->rowCount();
      
      ?>
      <h3><?=$buscar_total_listings;?></h3>
      <p>Total imoveis</p>
      <a href="listings.php" class="btn">Visualizar imoveis</a>
    </div>

    <div class="box">
      <?php 
      $selecionar_users= $conn ->prepare("SELECT * FROM `users` WHERE nivel_acesso = 0 ");
      $selecionar_users->execute();
      $buscar_total_users = $selecionar_users ->rowCount();
      
      ?>
      <h3><?=$buscar_total_users;?></h3>
      <p>Usuarios total</p>
      <a href="users.php" class="btn">Visualizar usarios</a>
    </div>

    <div class="box">
      <?php 
      $selecionar_message= $conn ->prepare("SELECT * FROM `messageS`  ");
      $selecionar_message ->execute();
      $buscar_total_mensage = $selecionar_message ->rowCount();
      
      ?>
      <h3><?=$buscar_total_mensage;?></h3>
      <p>Total mensagem</p>
      <a href="listings.php" class="btn">Visualizar mensagem</a>
    </div>


  </div>

</section>



    

<?php include ('components/message.php'); ?>

<script src="js/admin.js"></script>
</body>
</html>