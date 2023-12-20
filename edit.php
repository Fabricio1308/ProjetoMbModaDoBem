<?php

    session_start();

    include_once('config.php');


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


    if(!empty($_GET['id'])) {
        $id = $_GET['id'];

        $sql = $conexao->prepare("SELECT * FROM usuario WHERE id = ?");
        $sql->bind_param('s', $id); // 's' indica que $id é uma int
        $sql->execute();
        $result = $sql->get_result();
    
        if($result->num_rows > 0) {
                $nome = $_SESSION['nome'];
                $email = $_SESSION['email'];
                $cpf = $_SESSION['cpf'];
                $senha = $_SESSION['senha'];
                
        } else{
            header('Location: telaDePerfil.php');
        }

    
        $sql->close();    
    }
    else {
        header('Location: telaDePerfil.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/logo-azul.png" type="icon">
    <title>Editar Informações Pessoais</title>
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
        <main class="main-login-e-registro">
            <h1>Informações Pessoais</h1>

            <form method="post" action="saveEdit.php" id="formRegistrarUsuario">
                <div class="form-inputs">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>">

                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $email; ?>">

                    <label for="cpf">CPF</label>
                    <input type="number" name="cpf" id="cpf" value="<?php echo $cpf; ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength = "11" disabled>

                
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <input type="submit" name="update" value="Salvar" id="formCadastrar">

            </form>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>