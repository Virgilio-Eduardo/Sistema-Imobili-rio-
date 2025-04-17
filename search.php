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

if(isset($_POST['h_search'])){

  $h_service = $_POST['h_service'];
  $h_service = filter_var($h_service, FILTER_SANITIZE_STRING);

  $h_tipo_imovel = $_POST['h_tipo_imovel'];
  $h_tipo_imovel = filter_var($h_tipo_imovel, FILTER_SANITIZE_STRING);

  $h_localizacao = $_POST['h_localizacao'];
  $h_localizacao = filter_var($h_localizacao, FILTER_SANITIZE_STRING);

  $h_min = $_POST['h_min'];
  $h_min = filter_var($h_min, FILTER_SANITIZE_STRING);

  $h_max = $_POST['h_max'];
  $h_max = filter_var($h_max, FILTER_SANITIZE_STRING);

  $select_listings = $conn -> prepare("SELECT * FROM `property` WHERE 
  service LIKE '%{$h_service}%' AND tipo_de_imovel LIKE '%{$h_tipo_imovel}%' AND
   localizacao LIKE '%{$h_localizacao}%' AND preco BETWEEN 
   $h_min AND $h_max ORDER BY data DESC");
   $select_listings->execute();

 
}elseif(isset($_POST['filter_search'])){
  
  $service = $_POST['service'];
  $service = filter_var($service, FILTER_SANITIZE_STRING);

  $tipo_imovel = $_POST['tipo_imovel'];
  $tipo_imovel = filter_var($tipo_imovel, FILTER_SANITIZE_STRING);

  $localizacao = $_POST['localizacao'];
  $localizacao = filter_var($localizacao, FILTER_SANITIZE_STRING);

  $min = $_POST['min'];
  $min = filter_var($min, FILTER_SANITIZE_STRING);

  $max = $_POST['max'];
  $max = filter_var($max, FILTER_SANITIZE_STRING);

  $select_listings = $conn -> prepare("SELECT * FROM `property` WHERE 
  service LIKE '%{$service}%' AND tipo_de_imovel LIKE '%{$tipo_imovel}%' AND
   localizacao LIKE '%{$localizacao}%' AND preco BETWEEN 
   $min AND $max ORDER BY data DESC");
   $select_listings->execute();




} else{
  $select_listings = $conn -> prepare("SELECT * FROM `property`
  ORDER BY data DESC LIMIT 6");
  $select_listings ->execute();
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

<section class="filters">
 
<form action="" method="POST">
  <div id="close-filter"><i class=" fas fa-times"></i></div>
      <h3>Pesquisa</h3>

      <div class="box">
      
        <input type="text" name="localizacao" maxlength="100" required
        placeholder="Digite localização do imovel" class="input">
      </div>

      <div class="flex">
        <div class="box">
          <p>Tipo de imovel:</p>
          <select name="tipo_imovel" class="input" id="">
          <option value="casa">casa</option>
          <option value="flat">flat</option>
          <option value="apartamento">apartamento</option>
          <option value="loja">loja</option>
          <option value="terreno">terreno</option>
          </select>
        </div>


        <div class="box">
          <p>Pretende:</p>
          <select name="service" class="input" id="">
          <option value="vender">comprar</option>
          <option value="alugar">alugar</option>
      
          </select>
        </div>

        <div class="box">
        <p>Preço minimo:</p>
          <select name="min" class="input" id="">
          <option value="1000">1k</option>
          <option value="3000">3k</option>
          <option value="6000">6k</option>
          <option value="9000">9k</option>
          <option value="12000">12k</option>
          <option value="15000">15k</option>
          <option value="19000">19k</option>
          <option value="25000">25k</option>
          <option value="50000">50k</option>
          <option value="100000">100k</option>
          <option value="200000">200k</option>
          <option value="500000">500k</option>
          <option value="1000000">1lac</option>
          <option value="3000000">3lac</option>
          <option value="6000000">6lac</option>
          <option value="10000000">10lac</option>
          <option value="15000000">15lac</option>
          <option value="50000000">50lac</option>
          <option value="100000000">100lac</option>

          </select>

        </div>

        <div class="box">
        <p>Preço maximo:</p>
          <select name="max" class="input" id="">
          <option value="1000">1k</option>
          <option value="3000">3k</option>
          <option value="6000">6k</option>
          <option value="9000">9k</option>
          <option value="12000">12k</option>
          <option value="15000">15k</option>
          <option value="19000">19k</option>
          <option value="25000">25k</option>
          <option value="50000">50k</option>
          <option value="100000">100k</option>
          <option value="200000">200k</option>
          <option value="500000">500k</option>
          <option value="1000000">1lac</option>
          <option value="3000000">3lac</option>
          <option value="6000000">6lac</option>
          <option value="10000000">10lac</option>
          <option value="15000000">15lac</option>
          <option value="50000000">50lac</option>
          <option value="100000000">100lac</option>

          </select>

        </div>

      </div>

      <input type="submit" name="filter_search" value="Buscar" class="btnc">
     
  
    </form>

</section>

<div id="open-filters" class="fas fa-filer"></div>

  

  <!--Imoveis-->

  <section class="listings">
    <?php 
    if(isset($_POST['h_search']) OR isset($_POST['filter_search'])){
        echo'<h1 class="heading">Resultado</h1>';
    }else{
      echo'<h1 class="heading">Imoveis</h1>';

    }
    ?>

    <div class="box-container">
      <?php

       if ($select_listings ->rowCount() > 0){
        while($fetch_listings = $select_listings->fetch(PDO::FETCH_ASSOC)){

          $property_id = $fetch_listings['id'];

          $select_users = $conn-> prepare("SELECT * FROM `users` WHERE id = ?");
          $select_users->execute([$fetch_listings['user_id']]);
          $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);

          if(!empty($fetch_listings['img2'])){
            $count_img2 = 1;
          }else{
            $count_img2  = 0;
          }

          if(!empty($fetch_listings['img3'])){
            $count_img3 = 1;
          }else{
            $count_img3  = 0;
          }

          if(!empty($fetch_listings['img4'])){
            $count_img4 = 1;
          }else{
            $count_img4  = 0;
          }

          if(!empty($fetch_listings['img5'])){
            $count_img5 = 1;
          }else{
            $count_img5  = 0;
          }

          $total_img = (1 + $count_img2 + $count_img3 +
           $count_img4 + $count_img5);

          $select_saved = $conn->prepare("SELECT * FROM `saved` 
          WHERE property_id = ? AND user_id = ?");
          $select_saved->execute([$property_id, $user_id]);


  
      ?>

      <form action="" method="POST">
        <div class="box">
        <input type="hidden" name="property_id" value="<?= $property_id;?>">
         <?php  if ($select_saved->rowCount() > 0){?>

          <button type="submit" name="save" class="save"><i class="fas fa-heart"></i><span>salvado</span></button>

        <?php }else{?>
          <button type="submit" name="save" class="save"><i class="far fa-heart"></i><span>salvar</span></button>

        <?php }?>

        <div class="thumb">
          <p><i clasd="fas fa-image"></i><span><?= $total_img;?></span></p>
          <img src="uploaded_files/<?=$fetch_listings['img1'];?>" alt="">

        </div>

         <div class="admin">
          <h3><?= substr($fetch_users['nome'], 0, 1);?></h3>
           <div>
             <p><?=$fetch_users['nome'];?></p>
             <span><?=$fetch_listings['data'];?></span>

           </div>

         </div>
        </div>

        <div class="box">
          <p class="price"><i></i><span><?=$fetch_listings['preco'];?></span></p>
          <h3 class="name"><?=$fetch_listings['nome_imovel']?></h3>
          <p class="address"><i class="fas fa-map-marker-alt"></i><span><?=$fetch_listings['localizacao'];?></span></p>
         

          <div class="flex">
            <p><i class="fas fa-house"></i><span><?=$fetch_listings['tipo_de_imovel'];?></span></p>
            <p><i class="fas fa-tag"></i><span><?=$fetch_listings['service'];?></span></p>
            <p><i class="fas fa-bed"></i><span><?=$fetch_listings['quartos'];?></span></p>
            <p><i class="fas fa-bedroom"></i><span><?=$fetch_listings['banheiros'];?></span></p>
            <p><i class="fas fa-maximize"></i><span><?=$fetch_listings['tamanho'];?></span></p>
            <p><i class="fas fa-trowel"></i><span><?=$fetch_listings['status'];?></span></p>
            
            
          </div>
          <div class="flex-btn">
            <a href="view_propried.php?get_id=<?=$property_id;?>" 
            class="btnc"> Visualizar imovel</a>
            <input type="submit" value="enviar inquerito" name="send" class="btnA">

          </div>

        </div>

      
      </form>

      <?php 

       }

       }else{
       echo'<p class ="empty">Nenhum imovel encontrado!</p>';
       }  
      ?>

    </div> 


  </section>

  
  
 <?php include ('components/footer.php'); ?>


    <script src="js/script.js"></script>
    
    <?php include ('components/message.php'); ?>

    <script>

      document.querySelector('#filter-btn').onclick = () =>{
        document.querySelector('.filters').classList.add('active');
      }

      document.querySelector('#close-filter').onclick = () =>{
        document.querySelector('.filters').classList.remove('active');
      }

      
    </script>
    
  
  
</body>
</html>