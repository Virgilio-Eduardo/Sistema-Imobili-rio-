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

    <title>SOBRE</title>
</head>

   

<body> 
<?php include ('components/user_header.php'); ?>

  <div class="about">

    <div class="row">
      <div class="image">
        <img src="img/undraw_Mobile_us.png"  alt="">
      </div>

      <div class="content">
        <h3>Porque escolheu agente ?</h3>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, dolores repudiandae. 
          Iure architecto eaque ad quibusdam itaque cumque fugit nostrum!</p>

          <a href="contact.php" class="btnA"> Contactar-nos</a>


      </div>

    </div>

  </div>


  <div class="steps">

    <h1 class="heading">Simples steps</h1>

    <div class="box-container">

      <div class="box"> 
        <img src="img/house.png" alt="">
        <h3>Procurar Imovel</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure similique at nulla, velit veritatis ut culpa, error cupiditate porro, autem architecto! Commodi vero harum repellat, nulla fugiat delectus quae nemo?</p>

      </div>


      <div class="box"> 
        <img src="img/businessman.png" alt="">
        <h3>Contactar Corretor</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure similique at nulla, velit veritatis ut culpa, error cupiditate porro, autem architecto! Commodi vero harum repellat, nulla fugiat delectus quae nemo?</p>

      </div>


      <div class="box"> 
        <img src="img/buy-home (1).png" alt="">
        <h3>Aproveitar o seu Imovel</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure similique at nulla, velit veritatis ut culpa, error cupiditate porro, autem architecto! Commodi vero harum repellat, nulla fugiat delectus quae nemo?</p>

      </div>



    </div>

  </div>

  <section class="reviews">

    <h1 class="heading">Clients reviewes</h1>

    <div class="box-container">
      <div class="box">
        <div class="user">
          <img src="img/IMG_20220628_091403_634.jpg" alt="">
        
          <div>

              <h3>Vi Mundulay</h3>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>

            </div>
          </div>
        </div>

        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
          Praesentium dolorem beatae ratione deleniti quasi tempore sunt! Placeat nesciunt commodi explicabo.</p>
 

      </div>

      <div class="box">
        <div class="user">
          <img src="img/IMG_20220628_091403_634.jpg" alt="">
        
          <div>

              <h3>Vi Mundulay</h3>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>

            </div>
          </div>
        </div>

        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
          Praesentium dolorem beatae ratione deleniti quasi tempore sunt! Placeat nesciunt commodi explicabo.</p>
 

      </div>

      <div class="box">
        <div class="user">
          <img src="img/IMG_20220628_091403_634.jpg" alt="">
        
          <div>

              <h3>Vi Mundulay</h3>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>

            </div>
          </div>
        </div>

        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
          Praesentium dolorem beatae ratione deleniti quasi tempore sunt! Placeat nesciunt commodi explicabo.</p>
 

      </div>
      <div class="box">
        <div class="user">
          <img src="img/IMG_20220628_091403_634.jpg" alt="">
        
          <div>

              <h3>Vi Mundulay</h3>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>

            </div>
          </div>
        </div>

        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
          Praesentium dolorem beatae ratione deleniti quasi tempore sunt! Placeat nesciunt commodi explicabo.</p>
 

      </div>

      <div class="box">
        <div class="user">
          <img src="img/IMG_20220628_091403_634.jpg" alt="">
        
          <div>

              <h3>Vi Mundulay</h3>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>

            </div>
          </div>
        </div>

        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
          Praesentium dolorem beatae ratione deleniti quasi tempore sunt! Placeat nesciunt commodi explicabo.</p>
 

      </div>

      <div class="box">
        <div class="user">
          <img src="img/IMG_20220628_091403_634.jpg" alt="">
        
          <div>

              <h3>Vi Mundulay</h3>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>

            </div>
          </div>
        </div>

        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
          Praesentium dolorem beatae ratione deleniti quasi tempore sunt! Placeat nesciunt commodi explicabo.</p>
 

      </div>


    </div>

  </section>

<?php include ('components/footer.php'); ?>

    <script src="js/script.js"></script>

    <?php include ('components/message.php'); ?>
</body>

</html>
