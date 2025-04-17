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

if (isset($_POST['submit'])){
   

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);

  $password = sha1($_POST['password']);
  $password = filter_var($password, FILTER_SANITIZE_STRING);

  $verify_user = $conn ->prepare("SELECT * FROM `users` WHERE email= ?
        AND password = ? LIMIT 1");
        $verify_user->execute([$email, $password]);
     
        if($verify_user->rowCount() > 0){
          $row = $verify_user->fetch(PDO::FETCH_ASSOC);
        //Define os valores atribuidos na sessao do usuario

        
        if($row['nivel_acesso'] == 0 ){
          $_SESSION['usuarioId'] 		= $row['id'];
          $_SESSION['usuarioNumero'] 		= $row['numero'];
          $_SESSION['usuarioSenha'] 		= $row['senha'];
          $_SESSION['nivel_de_acesso'] 		= $row['nivel_acesso'];
          header('location:home.php');
        }

        
        if($row['nivel_acesso'] == 1 ){
          $_SESSION['usuarioId'] 			= $row['id'];
          $_SESSION['usuarioNumero'] 		= $row['numero'];
          $_SESSION['usuarioSenha'] 		= $row['senha'];
          $_SESSION['nivel_de_acesso'] 		= $row['nivel_acesso'];
          header('location:home_admin.php');
        }

        if($row['nivel_acesso'] == 5 ){
          $_SESSION['usuarioId'] 			= $row['id'];
          $_SESSION['usuarioNumero'] 		= $row['numero'];
          $_SESSION['usuarioSenha'] 		= $row['senha'];
          $_SESSION['nivel_de_acesso'] 		= $row['nivel_acesso'];
          header('location:painel_admin.php');
        }


          
        }else{
          $warning_msg[] ='incorreto email ou password!';
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


  <section class="form-container">
    <form action="" method="POST">
      <h3>Login</h3>
      <div class="box">
          <i></i><input type="email" name="email" required maxlength="50"  placeholder="Digite o seu e-mail">
          <i></i><input type="password" name="password" required maxlength="15"  placeholder="Digite o seu password" >

          <a href="cadastrar.php"> Ainda nao tenho cadastro</a>


       <input type="submit" value="Submeter" name="submit" class="btnA">


      </div>

    </form>
  </section>

<?php include ('components/footer.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 

    <script src="js/script.js"></script>
    

<?php include ('components/message.php'); ?>  
  
</body>
</html>