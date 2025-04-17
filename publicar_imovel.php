<?php 
include ('components/connect.php');


session_start();
if (isset($_SESSION['usuarioId'] ) && isset($_SESSION['nivel_de_acesso'])){
  $user_id = $_SESSION['usuarioId']; 
  $nivel_acesso = $_SESSION['nivel_de_acesso'];
}else{
  $user_id = '';
  $nivel_acesso= '';
  $info_msg[] ='Faça login, se não tens conta, cadastra-se!';
  header('location:login.php');
}

if(isset($_POST['post'])){

  $id = create_unique_id();

  $nome_imovel = $_POST['nome_imovel'];
  $nome_imovel = filter_var($nome_imovel, FILTER_SANITIZE_STRING);

  $preco = $_POST['preco'];
  $preco = filter_var($preco, FILTER_SANITIZE_STRING);

  $tamanho = $_POST['tamanho'];
  $tamanho = filter_var($tamanho, FILTER_SANITIZE_STRING);

  $localizacao = $_POST['localizacao'];
  $localizacao = filter_var($localizacao, FILTER_SANITIZE_STRING);

  $tipo_de_imovel = $_POST['tipo_de_imovel'];
  $tipo_de_imovel = filter_var($tipo_de_imovel, FILTER_SANITIZE_STRING);

  $service = $_POST['service'];
  $service = filter_var($service, FILTER_SANITIZE_STRING);

  $quartos = $_POST['quartos'];
  $quartos = filter_var($quartos, FILTER_SANITIZE_STRING);

  $banheiros = $_POST['banheiros'];
  $banheiros = filter_var($banheiros, FILTER_SANITIZE_STRING);

  $garragem = $_POST['garragem'];
  $garragem = filter_var($garragem, FILTER_SANITIZE_STRING);

  $status = $_POST['status'];
  $status = filter_var($status, FILTER_SANITIZE_STRING);

  $descricao = $_POST['descricao'];
  $descricao = filter_var($descricao, FILTER_SANITIZE_STRING);
  
  if(isset($_POST['varanda'])){
    $varanda = $_POST['varanda'];
    $varanda = filter_var($varanda, FILTER_SANITIZE_STRING);
  }else{
    $varanda ='no';
  }

  if(isset($_POST['terraco'])){
    $terraco = $_POST['terraco'];
    $terraco = filter_var($terraco, FILTER_SANITIZE_STRING);
  }else{
    $terraco ='no';
  }

  if(isset($_POST['escritorio'])){
    $escritorio = $_POST['escritorio'];
    $escritorio = filter_var($escritorio, FILTER_SANITIZE_STRING);
  }else{
    $escritorio ='no';
  }

  if(isset($_POST['piscina'])){
    $piscina = $_POST['piscina'];
    $piscina = filter_var($piscina, FILTER_SANITIZE_STRING);
  }else{
    $piscina ='no';
  }
 
  if(isset($_POST['churrasqueira'])){
    $churrasqueira = $_POST['churrasqueira'];
    $churrasqueira = filter_var($churrasqueira, FILTER_SANITIZE_STRING);
  }else{
    $churrasqueira ='no';
  }

  if(isset($_POST['salao_de_festas'])){
    $salao_de_festas = $_POST['salao_de_festas'];
    $salao_de_festas = filter_var($salao_de_festas, FILTER_SANITIZE_STRING);
  }else{
    $salao_de_festas ='no';
  }

  $img1 = $_FILES['img1']['name'];
  $img1 = filter_var($img1, FILTER_SANITIZE_STRING);
  $img1_ext = pathinfo($img1, PATHINFO_EXTENSION);
  $rename_img1 = create_unique_id().'.'.$img1_ext;
  $img1_tmp_name = $_FILES['img1']['tmp_name'];
  $img1_size =$_FILES['img1']['size'];
  $img1_folder = 'uploaded_files/'.$rename_img1;

  $img2 = $_FILES['img2']['name'];
  $img2 = filter_var($img2, FILTER_SANITIZE_STRING);
  $img2_ext = pathinfo($img2, PATHINFO_EXTENSION);
  $rename_img2 = create_unique_id().'.'.$img2_ext;
  $img2_tmp_name = $_FILES['img2']['tmp_name'];
  $img2_size =$_FILES['img2']['size'];
  $img2_folder = 'uploaded_files/'.$rename_img2;

$img3 = $_FILES['img3']['name'];
$img3 = filter_var($img3, FILTER_SANITIZE_STRING);
$img3_ext = pathinfo($img3, PATHINFO_EXTENSION);
$rename_img3 = create_unique_id().'.'.$img3_ext;
$img3_tmp_name = $_FILES['img3']['tmp_name'];
$img3_size =$_FILES['img3']['size'];
$img3_folder = 'uploaded_files/'.$rename_img3;

$img4 = $_FILES['img4']['name'];
$img4 = filter_var($img4, FILTER_SANITIZE_STRING);
$img4_ext = pathinfo($img4, PATHINFO_EXTENSION);
$rename_img4 = create_unique_id().'.'.$img4_ext;
$img4_tmp_name = $_FILES['img4']['tmp_name'];
$img4_size =$_FILES['img4']['size'];
$img4_folder = 'uploaded_files/'.$rename_img4;



$img5 = $_FILES['img5']['name'];
$img5 = filter_var($img5, FILTER_SANITIZE_STRING);
$img5_ext = pathinfo($img5, PATHINFO_EXTENSION);
$rename_img5 = create_unique_id().'.'.$img5_ext;
$img5_tmp_name = $_FILES['img5']['tmp_name'];
$img5_size =$_FILES['img5']['size'];
$img5_folder = 'uploaded_files/'.$rename_img5;

if(!empty($img2)){
  if($img2_size > 9000000){
    $warning_msg[] = 'tamanho de imagem 1 é muito grande';
  }else{
    move_uploaded_file($img2_tmp_name, $img2_folder);
  }
}else{
  $rename_img2 = '';
}


if(!empty($img3)){
  if($img3_size >  9000000){
    $warning_msg[] = 'tamanho de imagem 3 é muito grande';
  }else{
    move_uploaded_file($img3_tmp_name, $img3_folder);
  }
}else{
  $rename_img3 = '';
}

if(!empty($img4)){
  if($img4_size > 9000000){
    $warning_msg[] = 'tamanho de imagem 4 é muito grande';
  }else{
    move_uploaded_file($img4_tmp_name, $img4_folder);
  }
}else{
  $rename_img4 = '';
}

if(!empty($img5)){
  if($img5_size >  9000000){
    $warning_msg[] = 'tamanho de imagem 5 é muito grande';
  }else{
    move_uploaded_file($img5_tmp_name, $img5_folder);
  }
}else{
  $rename_img5 = '';
}



if($img1_size >9000000){
  $warning_msg[] = 'imagem 1 é muito grande';
}else{
  $post_property = $conn->prepare("INSERT INTO `property`(id, user_id, nome_imovel,
     preco, tamanho, localizacao, tipo_de_imovel, service, quartos, banheiros, 
     garragem, status, descricao, varanda, terraco, escritorio, piscina, churrasqueira, 
     salao_de_festas, img1, img2, img3, img4, img5 ) VALUES(?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$post_property->execute([$id, $user_id, $nome_imovel, $preco, $tamanho, $localizacao,
$tipo_de_imovel, $service, $quartos, $banheiros, $garragem, $status, $descricao,
 $varanda, $terraco, $escritorio, $piscina, $churrasqueira, $salao_de_festas, 
 $rename_img1, $rename_img2, $rename_img3, $rename_img4, $rename_img5]);

  move_uploaded_file($img1_tmp_name, $img1_folder );

  $sucess_msg[] ='publicado com sucesso!';
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
  <title>Publicar imovel</title>
</head>
<body>

<?php include ('components/user_header.php'); ?>

<section class="property-form">
  <form action="" method="post" enctype="multipart/form-data">
    <h3>Detalhes de Imoveis</h3>
    <div class="box">
      <p>nome do imovel <span>*</span></p>
      <input type="text" name="nome_imovel" maxlength="50" 
      required placeholder="Digite o nome do imovel" class="input" >

    </div>

    <div class="flex">

      <div class="box">
        <p>preço<span>*</span></p>
        <input type="number" name="preco" maxlength="10"  min="0" max="9999999999"
        required placeholder="Digite o preço" class="input" >
  
      </div>

      <div class="box">
        <p>tamanho do imovel<span>*</span></p>
        <input type="text" name="tamanho" maxlength="50" 
        required placeholder="Digite o comprimento e a largura do imovel" class="input" >
  
      </div>

      <div class="box">
        <p>localizaçäo<span>*</span></p>
        <input type="text" name="localizacao" maxlength="100"  min="0" max="9999999999"
        required placeholder="Digite a localizaçäo do imovel" class="input" >
  
      </div>

      <div class="box">
        <p>Tipo de imovel:<span>*</span></p>
        <select name="tipo_de_imovel" id="" class="input" required>
          <option value="casa">casa</option>
          <option value="flat">flat</option>
          <option value="apartamento">apartamento</option>
          <option value="loja">loja</option>
          <option value="terreno">terreno</option>
          <option value="projecto_obra">projecto de obra</option>
        </select>
  
      </div>

      <div class="box">
        <p>Pretende:<span>*</span></p>
        <select name="service" id="" class="input" required>
          <option value="vender">vender</option>
          <option value="alugar">alugar</option>
        </select>
  
      </div>

      <div class="box">
        <p>Quantos quartos:<span>*</span></p>
        <select name="quartos" id="" class="input" required>
          <option value="nenhum">nenhum</option>
          <option value="1">1 quarto</option>
          <option value="2">2 quartos</option>
          <option value="3">3 quartos</option>
          <option value="4">4 quartos</option>
          <option value="5">5 quartos</option>
          <option value="6">6 quartos</option>
          <option value="7">7 quartos</option>
          <option value="8">8 quartos</option>
          <option value="9">9 quartos</option>
          <option value="10">10 quartos</option>
        </select>
  
      </div>

      <div class="box">
        <p>Quantos banheiros:<span>*</span></p>
        <select name="banheiros" id="" class="input" required>
          <option value="nenhum">nenhum</option>
          <option value="1">1 banheiro</option>
          <option value="2">2 banheiros</option>
          <option value="3">3 banheiros</option>
          <option value="4">4 banheiros</option>
          <option value="5">5 banheiros</option>
          <option value="6">6 banheiros</option>
          <option value="7">7 banheiros</option>
          <option value="8">8 banheiros</option>
          <option value="9">9 banheiros</option>
          <option value="10">10 banheiros</option>
        </select>
  
      </div>

      <div class="box">
        <p>Quantas garragem:<span>*</span></p>
        <select name="garragem" id="" class="input" required>
          <option value="nenhum">nenhum</option>
          <option value="1">1 garragem</option>
          <option value="2">2 garragens</option>
          <option value="3">3 garragens</option>
          <option value="4">4 garragens</option>
        
        </select>
  
      </div>

    

      <div class="box">
        <p>Estado:<span>*</span></p>
        <select name="status" id="" class="input" required>
          <option value="disponivel">disponivel</option>
          <option value="indisponivel">indisponivel</option>
        
        </select> 
  
      </div>

    </div>

    <div class="box">
      <p>Descriçāo do imovel:<span>*</span></p>
      <textarea name="descricao" cols="30" rows="10" 
      maxlength="1000" required placeholder="Digite a descriçāo do imovel"
       class="input"></textarea>

    </div>

    <div class="checkbox">
      <p>Areas comuns:<span>*</span></p>
      <div class="ch">
      <span><input type="checkbox" name="varanda" value="yes"> varanda</span>
      <span><input type="checkbox" name="terraco" value="yes"> terraço</span>
      <span><input type="checkbox" name="escritorio" value="yes"> area de serviço</span>
      </div>
      
    </div>

    <div class="checkbox">
      <p>Areas Privativas:<span>*</span></p>
      <div class="ch">
      <span><input type="checkbox" name="piscina" value="yes"> piscina</span>
      <span><input type="checkbox" name="churrasqueira" value="yes"> churrasqueira</span>
      <span><input type="checkbox" name="salao_de_festas" value="yes"> salāo de festas</span>
      </div>
    </div>

    <div class="box">
      <p>imagem 01</p>
      <input type="file" name="img1" class="input" accept="image/*" required>

    </div>

    <div class="flex">
      <div class="box">
        <p>imagem 02</p>
        <input type="file" name="img2" class="input" accept="image/*" required>

      </div>

      <div class="box">
        <p>imagem 03</p>
        <input type="file" name="img3" class="input" accept="image/*" required>

      </div>

      <div class="box">
        <p>imagem 04</p>
        <input type="file" name="img4" class="input" accept="image/*" required>

      </div>

      <div class="box">
        <p>imagem 05</p>
        <input type="file" name="img5" class="input" accept="image/*" required>

      </div>
    </div>

    <input type="submit" name="post" value="Publicar imovel" class="btnA">


  </form>

</section>

<?php include ('components/message.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include ('components/footer.php'); ?>


    <script src="js/script.js"></script>

    <?php include ('components/message.php'); ?>

     
</body>
</html>