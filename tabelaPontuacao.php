<?php 
include_once "config.php";

session_start();

$email = $_SESSION['email'];
$sql = $conexao->prepare("SELECT imgUsuario FROM usuario WHERE email = ?");
$sql->bind_param('s', $email); // 'i' indica que $id é um número inteiro
$sql->execute();
$result = $sql->get_result();
$row = $result->fetch_assoc();
$imgUsuario = $row['imgUsuario'];


$sql->close();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo-azul.png" type="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Tabela Pontuação</title>
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

    <div class="align-column-tabelaPontuacao">
<div class="align-row-tabelaPontuacao">
    <div class="div-bg-tabelaPontuacao">
        <h4>Camisetas</h4>
        <p>Ruim: 10 Pontos</p>
        <p>Regular: 15 Pontos</p>
        <p>Bom: 20 Pontos</p>
        <p>Otimo: 30 Pontos</p>
    </div>


    <div class="div-bg-tabelaPontuacao">
        <h4>Calça</h4>
        <p>Ruim: 5 Pontos</p>
        <p>Regular: 10 Pontos</p>
        <p>Bom: 15 Pontos</p>
        <p>Otimo: 25 Pontos</p>
    </div>
</div>

    <div class="align-row-tabelaPontuacao">
    <div class="div-bg-tabelaPontuacao">
        <h4>Moletons</h4>
        <p>Ruim: 20 Pontos</p>
        <p>Regular: 30 Pontos</p>
        <p>Bom: 45 Pontos</p>
        <p>Otimo: 60 Pontos</p>
    </div>
   

    <div class="div-bg-tabelaPontuacao">
        <h4>Vestidos</h4>
        <p>Ruim: 15 Pontos</p>
        <p>Regular: 25 Pontos</p>
        <p>Bom: 30 Pontos</p>
        <p>Otimo: 40 Pontos</p>
    </div>
    </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>