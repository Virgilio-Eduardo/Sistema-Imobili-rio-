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

if(isset($_POST['enviar'])){  

  $message_id = create_unique_id();

  $nome = $_POST['nome'];
  $nome = filter_var($nome, FILTER_SANITIZE_STRING);

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);

  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);

  $message = $_POST['message'];
  $message = filter_var($message, FILTER_SANITIZE_STRING);

  $verify_messages = $conn -> prepare("SELECT * FROM `messages` WHERE 
 nome = ? AND email = ? AND number = ? AND message = ? ");
  $verify_messages -> execute([$nome, $email, $number, $message]);

  if ($verify_messages->rowCount() > 0 ){
    $warning_msg[] ='Messagem ja foi enviada!';
  }else{
    
  $insert_messages =  $conn -> prepare ("INSERT INTO `messages` 
  (id, nome, email , number, message) VALUES(?, ?, ?, ?, ?) ");
  $insert_messages->execute([$message_id, $nome, $email, $number, $message]);
  $sucess_msg[] ='Messagem enviada com sucesso!';

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
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->

    <title>CONTACTA-NOS</title>
</head>

   

<body> 

<?php include ('components/user_header.php'); ?>

 
  <section class="contact">

    <div class="row">
      <div class="image">
        <img src="img/undraw_Mobile_app_re_catg.png" alt="">
      </div>

      <form action="" method="POST">
        <h3>get in touch</h3>
        <input type="text" name="nome" required maxlength="50" class="box" placeholder="Digite o seu nome">
        <input type="email" name="email" required maxlength="50" class="box" placeholder="Digite o seu e-mail">
        <input type="number" name="number" required maxlength="12" max="999999999999" min="0" class="box" placeholder="Digite o seu numero">
        <textarea name="message" required maxlength="1000" placeholder="Digite a sua mensagem" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="Enviar mensagem" name="enviar" class="btnA">
      </form>

    </div>

  </section>


<?php include ('components/footer.php'); ?>

    <script src="js/script.js"></script>

<?php include ('components/message.php'); ?>
    
</body>

</html>
