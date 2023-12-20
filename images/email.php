<?php
session_start();
$emailEnvio = $_SESSION['email'];

if (isset($_POST["codigo"])) {
        
    $codigo = $_POST["codigo"];
    
}

    
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$email = new PHPMailer();
$email->isSMTP();
$email->Host = "smtp.gmail.com";
$email->SMTPAuth = "true";
$email->SMTPSecure = "tls";
$email->Port ="587";
$email->Username = "lemos1570@gmail.com";
$email->Password = "wnfjqhbyddqpmjaq";
$email->Subject = "Vouncher de desconto MB";
$email->setFrom("lemos1570@gmail.com");
$email->addStringAttachment(file_get_contents("https://quickchart.io/qr?text=$codigo"), "$codigo.jpg");
$email->Body = 'Aqui esta seu codigo: ' . $codigo .  ' obrigado!';
$email->addAddress("$emailEnvio");

if($email->Send()){
    header("location: telaDePerfil.php");
    echo" <h1>Email envidado </h1>";
}else{
    echo "nao enviado";
}
$email->smtpClose();