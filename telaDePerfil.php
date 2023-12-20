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

    $id = $_SESSION['id'];
    $imgUsuario = $_SESSION['imgUsuario'];


    $sql = $conexao->prepare("SELECT nome FROM usuario WHERE id = ?");
    $sql->bind_param('i', $id); // 'i' indica que $id é um número inteiro
    $sql->execute();
    $result = $sql->get_result();

    $row = $result->fetch_assoc();
    $nome = $row['nome'];

    $_SESSION['nome'] = $nome;

    $sql->close();


    $sql = $conexao->prepare("SELECT cpf FROM usuario WHERE id = ?");
    $sql->bind_param('i', $id); // 'i' indica que $id é um número inteiro
    $sql->execute();
    $result = $sql->get_result();

    $row = $result->fetch_assoc();
    $cpfUsuario = $row['cpf'];

    $_SESSION['cpf'] = $cpfUsuario;

    $sql->close();


    $sql = $conexao->prepare("SELECT senha FROM usuario WHERE id = ?");
    $sql->bind_param('i', $id); // 'i' indica que $id é um número inteiro
    $sql->execute();
    $result = $sql->get_result();

    $row = $result->fetch_assoc();
    $senhaUsuario = $row['senha'];

    $_SESSION['senha'] = $senhaUsuario;

    $sql->close();


    $sql = $conexao->prepare("SELECT email FROM usuario WHERE id = ?");
    $sql->bind_param('i', $id); // 'i' indica que $id é um número inteiro
    $sql->execute();
    $result = $sql->get_result();

    $row = $result->fetch_assoc();
    $email = $row['email'];

    $_SESSION['email'] = $email;

    $sql->close();


    $sql = $conexao->prepare("SELECT pontos FROM usuario WHERE id = ?");
    $sql->bind_param('i', $id); // 'i' indica que $id é um número inteiro
    $sql->execute();
    $result = $sql->get_result();

    $row = $result->fetch_assoc();
    $pontos = $row['pontos'];

    $_SESSION['pontos'] = $pontos;

    $sql->close();



 // Consulta SQL para buscar as categorias
 


 // recebe o arquivo para editar a foto de perfil
if (isset($_FILES["imagem"])) {

 
    // Verificar se um arquivo foi enviado corretamente
    if ($_FILES['imagem']['error'] === 0) {
        $pasta = "imgUsuarios/";
        $nomeDoArquivo = $_FILES['imagem']['name'];
        $novoNomeArq = uniqid();
        
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
 
        // Verificar se a extensão do arquivo é permitida
        $extensoesPermitidas = array("jpg", "png", "jpeg");
        if (in_array($extensao, $extensoesPermitidas)) {
            $path = $pasta . $nomeDoArquivo;
        
            
    // busca a img no banco para apagar 
    $sql = $conexao->prepare("SELECT imgUsuario FROM usuario WHERE id = ?");
    $sql->bind_param('i', $id); // 'i' indica que $id é um número inteiro
    $sql->execute();
    $result = $sql->get_result();

    $row = $result->fetch_assoc();
    $imgUsuarioApagar = $row['imgUsuario'];

// Verifique se o arquivo existe antes de tentar excluí-lo
if (file_exists("imgUsuarios/" . $imgUsuarioApagar)) {
    // exclui a foto  antiga
    unlink("imgUsuarios/" . $imgUsuarioApagar);
}else{ 
    echo "arquivo nao existe";
}
            // Mover o arquivo para a pasta de destino
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $path)) {
                $sql = "UPDATE usuario SET imgUsuario = '$nomeDoArquivo' WHERE cpf = $cpfUsuario"; // Atualizando com base no ID 1
        if ($conexao->query($sql) === TRUE) {
        
       
    } else {
        echo "Erro ao atualizar o registro: " . $conexao->error;
        
    }

            } else {
                echo "Erro ao mover o arquivo para a pasta de destino.";
            }
        } else {
            echo "Tipo de arquivo não aceito: $nomeDoArquivo";
        }
    } else {
        echo "Erro no upload do arquivo.";
    }
}


$sql = $conexao->prepare("SELECT imgUsuario FROM usuario WHERE id = ?");
    $sql->bind_param('i', $id); // 'i' indica que $id é um número inteiro
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
       <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/logo-azul.png" type="image/x-icon">
    <title>Perfil</title>
</head>
<style>

/* Seção Perfil */


.pontosParaRecompensa p {
    margin: 10px 0;
    font-weight: 500;
    font-size: 1.3rem;
}

.pontosParaRecompensa a {
    margin-top: 20px;
    padding: 1rem;

}

.pontosParaRecompensa {
    width: 30rem;
    height: 3rem; /* Ocupar 100% da largura do contêiner pai */
    margin-top: 1rem;
    text-align: center;
    height: auto;

     
}

.cameraEditaFoto {
   display: inline-block;
    cursor: pointer;
    padding: 10px 20px;
    background: #2160a9;
    color: white;
    border: none;
    border-radius: 5px;
    margin-left: 1rem;
    
  }
.userIcon {
     /* Ocupar 100% da largura do contêiner pai */
    width: 11rem; /* Largura máxima para evitar que a imagem fique muito grande */
    height: 11rem; /* Altura automática com base na largura para manter a proporção */
    border-radius: 50%; /* Usando 50% para obter um círculo */
    margin-left: 5rem;
    margin-top:2rem;
    margin-bottom: 2rem;
}

.logout{
    background-color: #f00;
    color: #fff;
    margin-bottom: 2rem;
    padding: 1rem 4rem;
    border-radius: 1rem;
    text-transform: uppercase;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.1rem;
}
.logout:hover{
    background-color: #dd0000;
}

@media (max-width: 600px) {
    

main#main-perfil {
    background-color: white;
    color: #2160a9;
    width: 24rem;
    height: 50rem;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 5%;
}

main#main-perfil h1 {
  color:  #2160a9;
}

main#main-perfil .usuario {
    display: flex;
    flex-direction: column; /* Mudando para coluna em telas menores */
    margin-bottom: 10px;
    margin-left: 0; /* Removendo a margem lateral */
    font-size: 1.1rem;
    height: 90vh;
}



.userIcon {
     /* Ocupar 100% da largura do contêiner pai */
    width: 10rem; /* Largura máxima para evitar que a imagem fique muito grande */
    height: 10rem; /* Altura automática com base na largura para manter a proporção */
    border-radius: 50%; /* Usando 50% para obter um círculo */
    margin-left: 5rem;
    margin-top:1rem;
    margin-bottom: 1rem;
}

.informacoesPessoais {
    margin-left: 0; /* Removendo a margem lateral */
     /* Reduzindo a margem inferior */
}

.informacoesPessoais h4 {
    margin: 20px 0 10px 0;
    font-size: 1.5em;
}

.informacoesPessoais p {
    font-size: 1em;
    margin: 10px 0 10px 0;
    font-weight: 600;
}

.pontosParaRecompensa {
    width: 100%; /* Ocupar 100% da largura do contêiner pai */
     /* Ajustando a margem */
    text-align: center;
    height: auto;

     
}

.pontosParaRecompensa p {
    margin: 10px 0;
    font-weight: 500;
    font-size: 1rem;
}

.pontosParaRecompensa a {
    margin-top: 20px;
    padding: 0.5rem;

}

#inputEditarFoto{
    display: none;
  }

  
  .cameraEditaFoto {
   display: inline-block;
    cursor: pointer;
    padding: 10px 20px;
    background: #2160a9;
    color: white;
    border: none;
    border-radius: 5px;
    margin-left: 3rem;
    
  }

  .continuarEditaFoto {
    display: inline-block;
   flex-direction: row;
    cursor: pointer;
    padding: 10px 20px;
    background: white;
    font-size: 1.3rem;
    color: #2160a9;
    border: none;
    border-radius: 5px;
   
  }
  .logout{
    background-color: #f00;
    color: #fff;
    margin-bottom: 2rem;
    padding: 1rem 4rem;
    border-radius: 1rem;
    text-transform: uppercase;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.1rem;
}
.logout:hover{
    background-color: #dd0000;
}
  .cameraEditaFoto input[type="file"] {
    display: none;
    
  }
}</style>
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
        <main id="main-perfil">
            
            <div class="usuario">

                <div class="informacoesPessoais">                
                    <h1><?php echo $nome; ?></h1>
                    
                    <p>E-mail: <?php echo $email; ?></p>
                    <p>Total de pontos: <?php echo $pontos = $pontos + 0; ?></p>
                    <a href="edit.php?id=<?php echo $id; ?>" class="editarInfo">Editar Informações Pessoais</a>
                    <br>
                    <a href="tabelaPontuacao.php" class="editarInfo">Tabela Pontuações</a>
              <div>
                    <img src="imgUsuarios/<?php if($imgUsuario == null){
                    echo "foto-perfila.png";
                    } else {
                        echo $imgUsuario;
                    } ?>"   alt="Foto do Perfil" title="Foto de Perfil" class="userIcon">            
         
<form method="POST" enctype="multipart/form-data">
  <label for="inputEditarFoto" class="cameraEditaFoto">
    <img src="images/camera-icon.png" alt="Ícone de upload" style="width: 20px; height: 20px; vertical-align: middle; margin-right: 5px;">
    Editar foto
</label>
<input type="submit" class="continuarEditaFoto" value="Trocar">
  <input type="file" name="imagem" id="inputEditarFoto" accept="image/png,image/jpeg,image/svg" required>
   
          </form>
        </div>
                </div>
                <div class="pontosParaRecompensa">
                    <p>Resgate vouchers de descontos com seus pontos para utilizar em nossas lojas parceiras.</p>
                    <a href="resgatarRecompensa.php">Resgatar Recompensa</a>
                </div>
                
            </div>
            
            
        </main>


       
                
    
        
                
        <a href="sair.php" class="logout">Sair</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        function abrirTabelaDePontuacoes() {
            // swal({
            //     title: "Tabela de Pontuações",
            //     text: "\nVestidos/Camisetas\n Ótimo\n   30 pontos\n Bom \n   20\n Regular\n   15\n Ruim\n    10\n\n\nMoletom/Jaqueta\n  Ótimo\n   60 pontos\n Bom \n   45 pontos\n Regular\n   30 pontos\n Ruim\n    20 pontos\n\n\nCalça/Shorts\n70 pontos"
            // });
            swal({
                title: "Tabela de Pontuações",
                text: "Vestidos/Camisetas\n\nÓtimo: 30 pontos\nBom: 20 pontos\nRegular: 15 pontos\nRuim: 10 pontos"
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>(function(){ var s = document.createElement('script'); var h =
document.querySelector('head') || document.body; s.charset="UTF-8"; s.src =
'https://cdn.assistive.com.br/plugin/AssistiveWebPlugin.js'; s.async = true; s.onload
= function(){ assistive.init({});}; h.appendChild(s); })(); </script>
</body>

</html>

