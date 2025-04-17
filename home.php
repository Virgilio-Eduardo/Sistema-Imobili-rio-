
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

    <title>Home</title>
</head>

   

<body> 

<?php include ('components/user_header.php'); ?>

 <div class="home">
  <section class="center">
    <form action="search.php" method="POST">
      <h3>Encontre sua casa perfeita</h3>

      <div class="box">
      
        <input type="text" name="h_localizacao" maxlength="100" required
        placeholder="Digite localização do imovel" class="input">
      </div>

      <div class="flex">
        <div class="box">
          <p>Tipo de imovel:</p>
          <select name="h_tipo_imovel" class="input" id="">
          <option value="casa">casa</option>
          <option value="flat">flat</option>
          <option value="apartamento">apartamento</option>
          <option value="loja">loja</option>
          <option value="terreno">terreno</option>
          <option value="projectoobra">projecto de obra</option>
          </select>
        </div>


        <div class="box">
          <p>Pretende:</p>
          <select name="h_service" class="input" id="">
          <option value="vender">comprar</option>
          <option value="alugar">alugar</option>
      
          </select>
        </div>

        <div class="box">
        <p>Preço minimo:</p>
          <select name="h_min" class="input" id="">
          <option value="1000">1000</option>
          <option value="3000">3000</option>
          <option value="6000">6000</option>
          <option value="9000">9000</option>
          <option value="12000">12000</option>
          <option value="15000">15000</option>
          <option value="19000">19000</option>
          <option value="25000">25000</option>
          <option value="50000">50000</option>
          <option value="100000">100000</option>
          <option value="200000">200000</option>
          <option value="500000">500000</option>
          <option value="1000000">1000000</option>
          <option value="3000000">3000000</option>
          <option value="6000000">6000000</option>
          <option value="10000000">10000000</option>
          <option value="15000000">15000000</option>
          <option value="50000000">50000000</option>
          <option value="100000000">100000000</option>

          </select>

        </div>

        <div class="box">
        <p>Preço maximo:</p>
          <select name="h_max" class="input" id="">
          <option value="1000">1000</option>
          <option value="3000">3000</option>
          <option value="6000">6000</option>
          <option value="9000">9000</option>
          <option value="12000">12000</option>
          <option value="15000">15000</option>
          <option value="19000">19000</option>
          <option value="25000">25000</option>
          <option value="50000">50000</option>
          <option value="100000">100000</option>
          <option value="200000">200000</option>
          <option value="500000">500000</option>
          <option value="1000000">1000000</option>
          <option value="3000000">3000000</option>
          <option value="6000000">6000000</option>
          <option value="10000000">10000000</option>
          <option value="15000000">15000000</option>
          <option value="50000000">50000000</option>
          <option value="100000000">100000000</option>

          </select>

        </div>

      </div>

      <input type="submit" name="h_search" value="Buscar" class="btnc">
     
  
    </form>

  </section>

 </div>
  
  
  <section class="services">

    <h3 class="heading">Nossos Serviços </h3>

    <div class="box-cotainer">
      <div class="box">
        <img src="img/deal (1).png" alt="">
        <h3>Comprar Imoveis</h3>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
          Itaque, soluta.</p>

      </div>

      <div class="box">
        <img src="img/buy-home (3).png" alt="">
        <h3>Alugar Imoveis</h3>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
          Itaque, soluta.</p>

      </div>

      <div class="box">
        <img src="img/buy-home (1).png" alt="">
        <h3>Vender Imoveis</h3>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
          Itaque, soluta.</p>

      </div>

      <div class="box">
        <img src="img/loan (1).png" alt="">
        <h3>Projecto de Obra </h3>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
          Itaque, soluta.</p>

      </div>

    </div>


  </section>
  
  <!--Imoveis-->

  <section class="listings">
    <h1 class="heading">Imoveis</h1>

    <div class="box-container">
      <?php

      $select_listings = $conn -> prepare("SELECT * FROM `property`
       ORDER BY data DESC LIMIT 6");
       $select_listings ->execute();
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
            <input type="submit" value="Solicitar" name="send" class="btnA">

          </div>

        </div>

      
      </form>

      <?php 

       }

       }else{
       echo'<p class ="empty">Nenhum imovel publicado!</p>';
       }  
      ?>

    </div> 

    <div class="viwsbtn" style="margin-top: 3rem; text-align:center;">
    <a href="listings.php" class="btnviews"> Visualizar todos</a>

    </div>

  </section>
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  
<?php include ('components/footer.php'); ?>

    <script src="js/restrita.js"></script>
    

 <?php include ('components/message.php'); ?>
</body>

</html>
