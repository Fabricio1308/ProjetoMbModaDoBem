<?php

// try {
    $dbHost = "Localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "mb";

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

//     $conexao = new PDO('mysql:host=localhost;dbname=mb', $user, $pass);
// } catch(PDOException $e) {
//     echo "Deu ruim $e";
// }
?>