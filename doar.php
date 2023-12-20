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

if(isset($_POST['enviar'])) {
    $qtdPecas = $_POST['qtdPecas'];
    $tipoRoupa = $_POST['selectTipoRoupa'];
    $estadoRoupa = $_POST['selectEstadoRoupa'];
    $localDoacao = $_POST['selectEtecParaDoar'];
    $email = $_SESSION['email'];

    // Consulta para buscar o ID do usuário
    $sql = $conexao->prepare("SELECT cpf FROM usuario WHERE email = ?");
    $sql->bind_param('s', $email); // 's' indica que $email é uma string
    $sql->execute();
    $result = $sql->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $cpfUsuario = $row['cpf']; // Obtém o valor 'id' do resultado da consulta
    } else {
        // Ocorreu um erro. Confira se os campos estão corretos.
        echo "Ocorreu um erro. Confira se os campos estão corretos.";
        exit;
    }

    $sql->close(); // Feche a primeira consulta preparada

    
     // Consulta para buscar o ID do usuário
     $sql = $conexao->prepare("SELECT id FROM usuario WHERE email = ?");
     $sql->bind_param('s', $email); // 's' indica que $email é uma string
     $sql->execute();
     $result = $sql->get_result();
     
     if ($result->num_rows === 1) {
         $row = $result->fetch_assoc();
         $idUsuario = $row['id']; // Obtém o valor 'id' do resultado da consulta
     } else {
         // Ocorreu um erro. Confira se os campos estão corretos.
         echo "Ocorreu um erro. Confira se os campos estão corretos.";
         exit;
     }

 
     $sql->close(); // Feche a primeira consulta preparada


     // Consulta para buscar o ID do usuário
     $sql = $conexao->prepare("SELECT * FROM doacao WHERE cpfUsuario = ?");
     $sql->bind_param('s', $cpfUsuario); // 's' indica que $email é uma string
     $sql->execute();
     $result = $sql->get_result();
     
     if ($result->num_rows < 5) {
       
     } else {
         // Ocorreu um erro. Confira se os campos estão corretos.
         ?>  <!DOCTYPE html>
         <html lang="pt-br">
         <head>
             <meta charset="UTF-8">
             <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.8.0/dist/sweetalert2.min.css" rel="stylesheet">
             <title>MB</title>
         </head>
         <body>
     
         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
             <script>
     
                 
     
     swal("Você atingiu o maximo de doações!", "", "error");
             </script>
            
             
         </body>
         </html><?php
         header('refresh:1.5;url=indexLogin.php');
         exit;
     }

 
     $sql->close(); // Feche a primeira consulta preparada
    
    // Consulta para inserir a doação
    $sql = $conexao->prepare("INSERT INTO doacao (`quantidade`, `tipoRoupa`, `EstadoRoupa`, `pontoEntrega`, `idUsuario`, `cpfUsuario`) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param('isssii', $qtdPecas, $tipoRoupa, $estadoRoupa, $localDoacao, $idUsuario, $cpfUsuario); // Defina os tipos e as variáveis
    $sql->execute();


    

}

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

    <div class="center">
        <main class="main-doar-roupas">
            <?php
                if(isset($_POST['enviar'])) {
                   if ($sql->affected_rows === 1) { 
                        
                        ?> <!DOCTYPE html>
                        <html lang="pt-br">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                             <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.8.0/dist/sweetalert2.min.css" rel="stylesheet">
                            <title>MB</title>
                        </head>
                        <body>
                    
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                            <script>
                    
                                
                    
                    swal("Doacão feita com sucesso", "", "success");
                            </script>
                           
                            
                        </body>
                        </html><?php
                        header('refresh:1.5;url=indexLogin.php');
                    } else {
                        echo "Erro ao Registrar Doação";
                    }
                }
            ?>


            <h1>Doar Roupas</h1>

            <form id="formRegistrarUsuario" action="doar.php" method="post">

                   
                  

                    <h3>Selecione o tipo da peça de roupa:</h3>

                    <div class="form-inputs">
                <select name="selectTipoRoupa" class="inputs-doar" id="selectTipoRoupa">
                    <option disabled >Selecione o tipo da roupa:</option>
                    <option value="Camisetas">Camisetas/Regatas</option>
                    <option value="Calcas">Calças</option>
                    <option value="Moletons">Jaquetas/Moletons</option>
                    <option value="Vestidos">Vestidos</option>
                </select>



                <h3>Selecione o estado da peça de roupa:</h3>

                <select name="selectEstadoRoupa" class="inputs-doar" id="selectEstadoRoupa">
                    <option disabled >Selecione o tipo da roupa:</option>
                    <option value="Ruim">Ruim</option>
                    <option value="Regular">Regular</option>
                    <option value="Bom" selected>Bom</option>
                    <option value="Otimo">Ótimo</option>
                </select>

                <h3 >Em qual ETEC gostaria de doar?</h3>


                <select name="selectEtecParaDoar"class="inputs-doar" id="selectEtecParaDoar">
                    <option disabled>Seleciona a Etec para doar</option>
                    <option value="Etec Barueri" selected>Etec Antônio Furlan Barueri</option>
                    <option value="Etec Jandira" disabled>Etec José Ephim Mindlin Jandira</option>
                </select> 
                <h3 >Quantidade de peças:</h3>
                <input type="number" name="qtdPecas"  id="qtdPecas" placeholder="Quantidade de peças:" min="1" max="30" required>
            </div>

                <input type="submit" value="Doar" id="formDoar" name="enviar">

               
                </div>
            </form>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>