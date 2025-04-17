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
   
  $id = create_unique_id();

  $nome = $_POST['nome'];
  $nome = filter_var($nome, FILTER_SANITIZE_STRING);

  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);

  $password = sha1($_POST['password']);
  $password = filter_var($password, FILTER_SANITIZE_STRING);

  $c_password = sha1($_POST['c_password']);
  $c_password = filter_var($c_password, FILTER_SANITIZE_STRING);

  $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
  $select_email->execute([$email]);

  if ($select_email->rowCount() > 0){
    $warning_msg[]='email ja recebido!';
  }else{
    if($password != $c_password){
      $warning_msg[] ='Password não combinam!';

    }else{
      $insert_user = $conn ->prepare("INSERT INTO `users`(id, nome, number,
       email, password, nivel_acesso) VALUES(?,?,?,?,?,?)");
       $insert_user->execute([$id, $nome, $number, $email, $c_password,1]);

       if($insert_user){
        $verify_user = $conn ->prepare("SELECT * FROM `users` WHERE email= ?
        AND password = ? LIMIT 1");
        $verify_user->execute([$email, $c_password]);
        $row = $verify_user->fetch(PDO::FETCH_ASSOC);

        if($verify_user->rowCount() > 0){
          
          $sucess_msg[] ='Cadastrado com sucesso';
          header('location:login.php');
        }else{
          $error_msg[] ='Algo deu errado!';
        }

       }

    }

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
    <title>Cadastrar</title>
</head>
<body>
<?php include ('components/user_header.php'); ?>

  <section class="form-container">
    <form action="" method="POST">
      <h3>Cadastrar</h3>
      <div class="box">
          <i></i><input type="text" name="nome" required maxlength="50"  placeholder="Digite o seu nome">

          <i></i><input type="number" name="number" required min="0" max="99999999999" maxlength="11" placeholder="Digite o seu numero de telefone">
          
          <i></i><input type="email" name="email" required maxlength="50" placeholder="Digite o seu e-mail">

          <i></i><input type="password" name="password" required maxlength="15"  placeholder="Digite o seu password">

          <i></i><input type="password" name="c_password" required maxlength="15"  placeholder="Digite o seu password novamente">

          <a href="login.php"> Ja tenho cadastro</a>


       <input type="submit" value="Submeter" name="submit" class="btnA">


      </div>

    </form>
  </section>


<?php include ('components/footer.php'); ?>


    <script src="js/script.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
<?php include ('components/message.php'); ?>
    
</body>
</html>