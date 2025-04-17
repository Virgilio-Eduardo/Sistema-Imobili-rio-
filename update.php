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

$select_account = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
$select_account->execute([$user_id]);
$fetch_account = $select_account->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){

  $nome = $_POST['nome'];
  $nome = filter_var($nome, FILTER_SANITIZE_STRING);

  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);

  if (!empty($nome)){
    $update_nome= $conn->prepare("UPDATE `users` SET nome = ? WHERE id = ? ");
    $update_nome->execute([$nome, $user_id]);
    $sucess_msg[] ='nome autualizado!';
  }

  if (!empty($number)){
    $update_number= $conn->prepare("UPDATE `users` SET number = ? WHERE id = ? ");
    $update_number->execute([$number, $user_id]);
    $sucess_msg[] ='numero autualizado!';
  }

  if (!empty($email)){
    $verify_email = $conn->prepare("SELECT email FROM `users` WHERE email = ?");
    $verify_email->execute([$email]);
    if($verify_email->rowCount() > 0){
      $warning_msg[] ='email ja recebido';


    }else{
    $update_email= $conn->prepare("UPDATE `users` SET email = ? WHERE id = ? ");
    $update_email->execute([$email, $user_id]);
    $sucess_msg[] ='email autualizado!';

    }

    
  }

  $empty_password = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
  $prev_password = $fetch_account['password'];
  $old_password = sha1($_POST['old_password']);
  $old_password = filter_var($old_password, FILTER_SANITIZE_STRING);
  $new_password = sha1($_POST['new_password']);
  $new_password = filter_var($new_password, FILTER_SANITIZE_STRING);
  $c_password = sha1($_POST['c_password']);
  $c_password = filter_var($c_password, FILTER_SANITIZE_STRING);

  if ($empty_password != $old_password){
    if($old_password != $prev_password){
      $warning_msg[] = 'password antigo incorreto!';
    }elseif($c_password != $new_password){
      $warning_msg[] = 'password diferentes!';
    }else{
      if($new_password != $empty_password){
        $update_password = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ? ");
        $update_password->execute([$c_password, $user_id]);
        $sucess_msg[] = 'password atualizado!';

      }else{
        $warning_msg[] = 'por favor digite novo password!';
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
  <title>Atualizar</title>
</head>
<body>

<?php include ('components/user_header.php'); ?>


 <section class="form-container">
    <form action="" method="POST">
      <h3>Atualizar Perfil</h3>
      <div class="box">
          <i></i><input type="text" name="nome"  maxlength="50"  placeholder="<?= $fetch_account['nome']; ?>">

          <i></i><input type="number" name="number"  min="0" max="99999999999" maxlength="11" placeholder="<?= $fetch_account['number']; ?>">
          
          <i></i><input type="email" name="email"  maxlength="50" placeholder="<?= $fetch_account['email']; ?>">

          <i></i><input type="password" name="old_password"  maxlength="15"  placeholder="Digite o seu antigo password">

          <i></i><input type="password" name="new_password"  maxlength="15"  placeholder="Digite o seu novo password">

          <i></i><input type="password" name="c_password"  maxlength="15"  placeholder="Confirma o seu novo password">


       <input type="submit" value="Atualizar" name="submit" class="btnA">


      </div>

    </form>
  </section>


<?php include ('components/footer.php'); ?>


    <script src="js/script.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
<?php include ('components/message.php'); ?>

