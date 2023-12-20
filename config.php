<?php

$servername = "127.0.0.1:3306";
$username = "u442075365_mbmodadobem";
$password = "1308143154Fa";
$database = "u442075365_mb";

// Criando a conexão
$conexao = new mysqli($servername, $username, $password, $database);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
} else {
    
}
// try {
    // $dbHost = "Localhost";
    // $dbUsername = "root";
    // $dbPassword = "";
    // $dbName = "mb";

    // $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

//     $conexao = new PDO('mysql:host=localhost;dbname=mb', $user, $pass);
// } catch(PDOException $e) {
//     echo "Deu ruim $e";
// }
?>