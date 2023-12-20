<?php

  session_start();
  // print_r($_SESSION);
  
  include("config.php");
  

  if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
  } else{
    $logado = $_SESSION['email'];
  } 


  $sql = $conexao->prepare("SELECT imgUsuario FROM usuario WHERE email = ?");
  $sql->bind_param('s', $logado); // 'i' indica que $id é um número inteiro
  $sql->execute();
  $result = $sql->get_result();
  
  $row = $result->fetch_assoc();
  $imgUsuario = $row['imgUsuario'];
  
  $_SESSION['imgUsuario'] = $imgUsuario;
  
  $sql->close();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Biblioteca slick slider -->
  <link rel="stylesheet" type="text/css" href="slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="images/logo-azul.png" type="icon">
  <title>Moda do Bem</title>

</head>

<body>

  <header>

  
  <nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="indexLogin.php"><img src="images/logo-branca.png" alt="Logo Moda do Bem" title="Logo Moda do Bem"
                    class="logo"></a>
    <div class="foto-tirarD">
    <a class="navbar-brand" href="telaDePerfil.php"><img src="imgUsuarios/<?php if($imgUsuario == null){
                    echo "foto-perfil.png";
                    } else {
                        echo $imgUsuario;
                    } ?>" style="border-radius: 80px; height: 50px; widht: 40px ;" alt="Imagem do Perfil" title="Imagem de Perfil"></a>
                    </div>
<button class="navbar-toggler bg-body-tertiary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
       <a class="nav-link " href="novidades.php">Novidades</a>         
        </li>
        <li class="nav-item">
        <a class="nav-link" href="sobre-nos.php">Sobre Nós</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="doar.php">Doar</a>
        </li>
        <li class="nav-item">
       
        </li>
      </ul>
      <span class="navbar-text">

      <div class="foto-tirar">
        <a class="navbar-brand" href="telaDePerfil.php"><img src="imgUsuarios/<?php if($imgUsuario == null){
                    echo "foto-perfil.png";
                    } else {
                        echo $imgUsuario;
                    } ?>" style="border-radius: 80px; height: 50px; widht: 40px ;" alt="Imagem do Perfil" title="Imagem de Perfil"></a>
</div>
      </span>
    </div>
  </div>
</nav>

              
     
  </header>
 <div class="center">
    <main id="main-index">
      <section class="text">
        <h3 class="diferenca">Faça a Diferença</h3>
        <p class="p-text">Você tem peças de roupas que não servem mais, ou que não cabem em seu guarda-roupa ? por
          que não doar e
          ajudar os necessitados.</p>
        <p class="p-text">Com nosso sitema de recompensas, você pode até ganhar uma roupa nova. O que acha?</p>
      </section>
      <section class="img">
        <img src="images/coracao-crianca.png" class="coracao-crianca" alt="Crianças fazendo coração com as mãos"
          title="Crianças fazendo coração com as mãos">
          <div class="align-doar-index">
          <div class="doar-index"><a href="doar.php" >Doar Agora</a></div>
        </div>
        </section>
    </main>
    <div class="contato">

      <div>
        <p class="whatsapp">Nos contate via</p>
        <p><a href="#" class="whatsapp">WhatsApp: (+55) 11 91637-3050</a></p>
      </div>
      <div class="redes-sociais">
       <p><img src="images/intagram-icon.png" class="icons" alt="Logo Intagram" title="Logo Intagram"><a href="https://www.instagram.com/mb.modadobem"
            class="icon-url" target="_blank">Moda
            do Bem</a></p>
       
        <p><img src="images/linkedin.png" class="icons" alt="Logo Linkedin" title="Logo Linkedin"><a href="https://www.linkedin.com/in/moda-do-bem-6b85a32a3"
            class="icon-url" target="_blank">Moda
            do Bem</a></p>
      </div>

    </div>

    <div class="carrossel">
      <div><img src="images/carrossel1.png" alt="Imagem Carrossel 1" id="imgCarrossel" title="Separe e Organize"></div>
      <div><img src="images/carrossel2.png" alt="Imagem Carrossel 2" id="imgCarrossel" title="Em Sacolas ou Caixas">
      </div>
      <div><img src="images/carrossel3.png" alt="Imagem Carrossel 3" id="imgCarrossel" title="Leve ao Nosso Centro">
      </div>
    </div>


    <section class="convite">
      <h3 class="diferenca-footer">Faça A Diferença Com Uma Simples Atitude</h3>
      <p>Ao se tornar um doador do MODA DO BEM, você está se juntando a uma grande rede de solidariedade
        que está transformando a vida de milhares de pessoas que vivem em situação de extrema pobreza na região mais
        carente do nosso país.</p>
      <p>Seu apoio é fundamental para continuarmos transformando vidas e comunidades inteiras.
        Não perca a oportunidade de fazer a diferença na vida de quem mais precisa.</p>
      <p>Doe agora e faça parte dessa mudança!</p>
    </section>

    <footer id="footer-index">
      <img src="images/logo-branca.png" class="logo" alt="Logo Moda do Bem" title="Logo Moda do Bem">
      <p>Conheça mais sobre o nosso trabalho através do site e das nossas Redes Sociais.</p>
    </footer>

    <!-- Fim Div Center -->
  </div>

  <!-- JS Slick slider -->
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="slick/slick.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.carrossel').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: true,
        dots: true,
        fade: true
      });
    });
  </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>(function(){ var s = document.createElement('script'); var h =
document.querySelector('head') || document.body; s.charset="UTF-8"; s.src =
'https://cdn.assistive.com.br/plugin/AssistiveWebPlugin.js'; s.async = true; s.onload
= function(){ assistive.init({});}; h.appendChild(s); })(); </script>
</body>

</html>