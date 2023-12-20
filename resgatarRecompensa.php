<?php

    include_once('config.php');
    
    session_start();
    
  if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
  } else{
    $logado = $_SESSION['email'];
  } 

    $imgUsuario = $_SESSION['imgUsuario'];
    $id = $_SESSION['id'];

    $sql = $conexao->prepare("SELECT pontos FROM usuario WHERE id = ?");
    $sql->bind_param('i', $id); // 'i' indica que $id é um número inteiro
    $sql->execute();
    $result = $sql->get_result();

    $row = $result->fetch_assoc();
    $pontos = $row['pontos'];

    $_SESSION['pontos'] = $pontos;

    $sql->close();


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo-azul.png" type="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    <title>MB - Novidades</title>
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
        <main id="main-resgatar-recompensa">
            <h1>Selecione Sua Recompensa</h1>

            <h2>Você Possui <?php echo $pontos; ?> pontos</h2>

            <section>
                <article>
                    <a href="resgatar-50reais.php">
                        <img src="images/voucher15.png" alt="Cartão Vale Presente" title="Cartão Vale Presente" style="width: 80%; border-radius: 1rem;">
                    </a>
                </article>
                <article>
                    <a href="resgatar-100reais.php">
                        <img src="images/voucher25.png" alt="Cartão Vale Presente" title="Cartão Vale Presente"  style="width: 80%; border-radius: 1rem;">
                    </a>
                </article>
            </section>
            <div class="center">
                
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>