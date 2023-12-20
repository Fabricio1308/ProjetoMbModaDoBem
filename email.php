<?php
session_start();
$emailEnvio = $_SESSION['email'];

if (isset($_POST["codigo"])) {
        
    $codigo = $_POST["codigo"];
    
}

    
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
$email->Subject = "Vouncher de desconto MB";
$email->setFrom("mbmodadobem@gmail.com");
$email->addStringAttachment(file_get_contents("https://quickchart.io/qr?text=$codigo"), "$codigo.jpg");
$email->Body = 'Aqui esta seu codigo: ' . $codigo .  ' obrigado!';
$email->addAddress("$emailEnvio");

if($email->Send()){
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

            

swal("Codigo enviado para o email com sucesso!", "", "success");
        </script>
       
        
    </body>
    </html><?php
     header('refresh:1.5;telaDePerfil.php');
}else{
    echo "nao enviado";
}
$email->smtpClose();