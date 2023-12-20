<?php
include("config.php");
session_start();

$email = $_SESSION['email'];
$sql = $conexao->prepare("SELECT imgUsuario FROM usuario WHERE email = ?");
$sql->bind_param('s', $email); // 'i' indica que $id é um número inteiro
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/logo-azul.png" type="icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  <title>Sobre Nós</title>
</head>

<style>
  /* Seção Sobre Nós */
main#main-sobre-nos {
    padding: 5%; /* Usando porcentagem para ser responsivo */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

main#main-sobre-nos h1 {
    text-transform: uppercase;
    margin-bottom: 30px; /* Reduzindo a margem inferior */
    font-size: 2em; /* Ajustando o tamanho da fonte */
}

main#main-sobre-nos p {
    font-size: 1.2em; /* Ajustando o tamanho da fonte */
    text-align: justify;
    width: 100%; /* Ocupar 100% da largura do contêiner pai */
    max-width: 800px; /* Largura máxima para evitar que o texto se estenda demais */
    margin-bottom: 30px; /* Reduzindo a margem inferior */
}
</style>

<body>

  <header>
  
    <nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="indexLogin.php"><img src="images/logo-branca.png" alt="Logo Moda do Bem" title="Logo Moda do Bem"
                    class="logo"></a>
    <div class="foto-tirarD">
    <a class="navbar-brand" href="telaDePerfil.php"><img src="imgUsuarios/<?php if($imgUsuario == null){
                    echo "images/foto-perfil.png";
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
  <main id="main-sobre-nos">
    <h1>Sobre Nós</h1>
    <p>A Moda do Bem surgiu em 2023, através de uma ideia para o TCC(Trabalho de Conclusão de Curso) dos nossos
      desenvolvedores, na Etec Antônio Furlan. Os desenvolvedores visavam algo inovador, criativo e bastante funcional,
      criando assim este site de doações.
      O Moda do Bem é um site que permite que tanto o doador como o receptor desta doação possam ser beneficiados,
      incentivando assim o aumento nas doações e ajudando a quem precisa. Ele consiste em cadastrar uma roupa, onde ela
      passará por uma espécie de verificação por um de nossos agentes, e o doador receberá uma certa quantia de pontos,
      em que, se somados, podem ser trocados por cartões vale-presente de lojas de roupas, para que possa ser realizado
      esse ciclo onde ninguém sai perdendo.
      Venha doar suas roupas que você já não utiliza mais! Não dizem por aí que quando uma pessoa faz o bem, ela será
      recompensada no futuro? Pois é, aqui você faz o bem e pode ser recompensado agora, no presente mesmo.</p>
    <p><b>Moda do Bem, conectando você à quem precisa!</b></p>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>(function(){ var s = document.createElement('script'); var h =
document.querySelector('head') || document.body; s.charset="UTF-8"; s.src =
'https://cdn.assistive.com.br/plugin/AssistiveWebPlugin.js'; s.async = true; s.onload
= function(){ assistive.init({});}; h.appendChild(s); })(); </script>
</body>

</html>