<?php
session_start();

include_once "config.php";

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$operacao = "SALVAR";

$nome = "";
$email = "";
$cpf = "";
$senha = "";


// Use um marcador de posição para o parâmetro :id
$select = $conexao->prepare("SELECT * FROM usuario WHERE id = ?");
$select->bind_param('i', $id); // 'i' indica que é um valor inteiro
$select->execute();
$result = $select->get_result();

if($result->num_rows == 1){
    header("location: index.html");
} else {

    if($result->num_rows == 0){

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
    
                
    
    swal("Email ou CPF ja cadastrado", "", "error");
            </script>
           
            
        </body>
        </html><?php
        header('refresh:1.5;url=registro.html');
}else{
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
    
                
    
    swal("Cadastro efetuado com sucesso!", "", "error");
            </script>
           
            
        </body>
        </html><?php
        header('refresh:1.5;url=login.html');
}}


if ($x = $result->fetch_assoc()) {
    $nome = $x['nome'] ?? "";
    $email = $x['email'] ?? "";        
    $cpf = $x['cpf'] ?? "";
    $senha = $x['senha'] ?? "";
    $operacao = "ATUALIZAR";
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? "";
    $email = $_POST['email'] ?? "";
    $cpf = $_POST['cpf'] ?? "";
    $senha = $_POST['senha'] ?? "";
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $pegarNumCpf = preg_replace('/[^0-9]/', '', $cpf);
    $cpf = $pegarNumCpf;
    if ($id) {
        $operacao = "Atualização";
        $update = $conexao->prepare("UPDATE `usuario` SET `nome`=?, `email`=?, `cpf`=?, `senha`=? WHERE id = ?");
        $update->bind_param('ssisi', $nome, $email, $cpf, $senha, $id);
        $foi = $update->execute();
    } else { if(strpos($email, '@adminmodadobem') !== false){
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
    
                
    
    swal("", "", "error");
            </script>
           
            
        </body>
        </html><?php
        header('refresh:1.5;url=registro.html');
        
    }else{ 
        $operacao = "Cadastro";
        $insert = $conexao->prepare("INSERT INTO `usuario` (`nome`, `email`, `cpf`, `senha`) VALUES (?, ?, ?, ?)");
        $insert->bind_param('ssis', $nome, $email, $cpf, $hash);
        $foi = $insert->execute();
    }
    }

    if ($foi) {

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
    
                
    
    swal("Cadastro efetuado com sucesso!", "", "success");
            </script>
           
            
        </body>
        </html><?php
         $sql = $conexao->prepare("SELECT id FROM usuario WHERE email = ?");
         $sql->bind_param('s', $email); // 's' indica que $email é uma string
         $sql->execute();
         $result = $sql->get_result();
     
         $row = $result->fetch_assoc();
         $id = $row['id'];
     
         $_SESSION['id'] = $id;
     
         $sql->close();
        $_SESSION['emailverificar'] = $email;
        header('refresh:1.5;url=emailVerifica1.php');
    } else {

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
    
                
    
    swal("Email ja cadastrado", "", "error");
            </script>
           
            
        </body>
        </html><?php
        header('refresh:1.5;url=registro.html');
    }
}

?>