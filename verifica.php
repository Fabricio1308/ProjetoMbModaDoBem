<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Biblioteca slick slider -->
  <link rel="shortcut icon" href="images/logo-azul.png" type="icon">
  <title>Moda do Bem</title>

</head>
</html>

<?php
include 'config.php';
session_start();
 $codigo = $_SESSION['codigoA']; 



if (isset($_POST['submit']) && !empty($_POST['numero'])) {
    $numero = $_POST['numero'];


    if($numero == $codigo){
       
        $id = $_SESSION['id'];
        $verifica = 1;

        $sql = "UPDATE usuario SET verificacao = '$verifica' WHERE id = $id"; // Atualizando com base no ID 1
        if ($conexao->query($sql) === TRUE) {
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
        
                    
        
        swal("Verificação Concluída com sucesso!", "", "success");
                </script>
               
                
            </body>
            </html><?php
            header('refresh:3;url=login.html');
        } else {
            echo "Erro ao atualizar o registro: " . $conexao->error;
        }

        
    } else{
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
    
                
    
    swal("Codigo de verificação incorreto tente novamente!", "", "error");
            </script>
           
            
        </body>
        </html><?php
        header('refresh:1.5;url=verificaTeste.html');
    }

   


}