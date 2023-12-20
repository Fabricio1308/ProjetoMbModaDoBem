<!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.8.0/dist/sweetalert2.min.css" rel="stylesheet">
            <title>Moda do bem</title>
        </head>
        <style>
            .principalVouncher{
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 17rem;
            }

            .principal-vouncher{
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                border-radius: 3rem;
                width: 25rem;
                height: 15rem;
                color: #2160a9;
                background-color: white;
            }
        </style>

    </html>
<?php
session_start();

include("config.php");

  if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
  } else{
    $logado = $_SESSION['email'];
  } 
$email = $_SESSION['email'];


// Consulta para buscar o ID do usuário
$sql = $conexao->prepare("SELECT pontos FROM usuario WHERE email = ?");
$sql->bind_param('s', $email); // 's' indica que $email é uma string
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $pontosUsuario = $row['pontos']; // Obtém o valor 'id' do resultado da consulta
} 

$sql->close(); // Feche a primeira consulta preparada

$sql = $conexao->prepare("SELECT cpf FROM usuario WHERE email = ?");
$sql->bind_param('s', $email); // 's' indica que $email é uma string
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $guardaCpf = $row['cpf']; // Obtém o valor 'id' do resultado da consulta
} 

$sql->close(); // Feche a primeira consulta preparada


$sql = $conexao->prepare("SELECT id FROM usuario WHERE email = ?");
$sql->bind_param('s', $email); // 's' indica que $email é uma string
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $guardaId = $row['id']; // Obtém o valor 'id' do resultado da consulta
} 

$sql->close(); // Feche a primeira consulta preparada


if($pontosUsuario >= 900){

    $pontosUsuario = $pontosUsuario - 900;
    ?>  <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.8.0/dist/sweetalert2.min.css" rel="stylesheet">
            <title>Document</title>
        </head>


        <body>
         

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
    
                
    
    swal("Vouncher resgatado!", "seus pontos: <?php echo $pontosUsuario ?>", "success");
            </script>
           
            
        </body>
        </html><?php


 
    // Atualiza a linha com os novos dados
    $sql = "UPDATE usuario SET pontos = '$pontosUsuario' WHERE cpf = $guardaCpf"; // Atualizando com base no ID 1
    if ($conexao->query($sql) === TRUE) {
       
$numero_aleatorio = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
$codigo = "MDB15".$guardaId.$numero_aleatorio.$numero_aleatorio - 126;

    } else {
        echo "Erro ao atualizar o registro: " . $conexao->error;
    }
} else {
    ?>  <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.8.0/dist/sweetalert2.min.css" rel="stylesheet">
            <title>Document</title>
        </head>
        <body>
    
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
    
                
    
    swal("Pontos insuficientes!", "seus pontos: <?php echo $pontosUsuario ?>", "error");
            </script>
           
            
        </body>
        </html><?php
 header('refresh:1.5;url=resgatar-50reais.php');
 

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
    </style>
    <link rel="shortcut icon" href="images/logo-azul.png" type="icon">
    <title>Login</title>
</head>

<body>

    <header>
        
    </header>


    <div class="principalVouncher">
        <main class="principal-vouncher">
         <form action="email.php" method="post">
            <h1 >seu codigo para resgate: <?php echo $codigo; ?></h1>

            <h2>Pontos restantes: <?php echo $pontosUsuario; ?></h2>
             <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
           
           
             <input style="margin-top: 2rem; background-color: #2160a9; padding: 0.5rem 1rem; color: #fff; border-radius: 0.5rem; text-decoration: none;" type="submit" name="enviar" value ="enviar para o email">
        </form>
        </main>
    </div>

</body>

</html>


