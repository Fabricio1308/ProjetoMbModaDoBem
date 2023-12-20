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
session_start();

$emailenvio = $_SESSION['emailverificar'];

if (isset($_POST["codigo"])) {
        
    $codigo = $_POST["codigo"];
    
}
$_SESSION['codigoA'] = $codigo ;
    
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$email = new PHPMailer();
$email->isSMTP();
$email->Host = "smtp.gmail.com";
$email->SMTPAuth = "true";
$email->SMTPSecure = "tls";
$email->Port ="587";
$email->Username = "mbmodadobem@gmail.com";
$email->Password = "uypmnwmtwvnbfftc";
$email->Subject = "Codigo de confirmação de email";
$email->setFrom("mbmodadobem@gmail.com");
$email->Body = 'Aqui esta seu codigo: ' . $codigo .  ' obrigado!';
$email->addAddress("$emailenvio");

if($email->Send()){
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

            

swal("Email enviado com sucesso!", "", "success");
        </script>
       
        
    </body>
    </html><?php
    header('refresh:3;url=emailVerifica2.html');
}else{
    echo "nao enviado";
    var_dump($emailenvio);
}
$email->smtpClose();