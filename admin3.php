<?php

include('config.php');
session_start();
$guardaCpf = $_SESSION['guardaCpf'];
$guardaID = $_SESSION['guardaID'];
 $email = $_SESSION['email'];
 if(strpos($_SESSION['email'] = $email, '@adminmodadobem') !== false){
    $_SESSION['email'] = $email;
     
}else{ header('location: login.html');}
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset(($_POST["parametroId"]))) {
    ?> 
    
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.8.0/dist/sweetalert2.min.css" rel="stylesheet">
        <title>Document</title>
    </head>
    <body>

        <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.8.0/dist/sweetalert2.all.min.js ">
        </script>
     
        
    </body>
    </html>
    
    
    
    <?php    
    sleep(1.5);
    $qtdPecas = $_POST['qtdPecas'];
    $tipoRoupa = $_POST['selectTipoRoupa'];
    $estadoRoupa = $_POST['selectEstadoRoupa'];
    $parametroId = $_POST['parametroId'];
     
    
 
switch ($tipoRoupa) {
     case "camisetas":
         switch ($estadoRoupa) {
             case "ruim":
                 $pontos = 10;
                 break;
             case "regular":
                 $pontos = 15;
                 break;
             case "bom":
                 $pontos = 20;
                 break;
             case "otimo":
                 $pontos = 30;
                 break;
         }
         break;
     case "calcas":
        switch ($estadoRoupa) {
            case "ruim":
                $pontos = 5;
                break;
            case "regular":
                $pontos = 10;
                break;
            case "bom":
                $pontos = 15;
                break;
            case "otimo":
                $pontos = 25;
                break;
        }
         break;
     case "moletons":
        switch ($estadoRoupa) {
            case "ruim":
                $pontos = 20;
                break;
            case "regular":
                $pontos = 30;
                break;
            case "bom":
                $pontos = 45;
                break;
            case "otimo":
                $pontos = 60;
                break;
        }
         break;
     case "vestidos":
        switch ($estadoRoupa) {
            case "ruim":
                $pontos = 15;
                break;
            case "regular":
                $pontos = 25;
                break;
            case "bom":
                $pontos = 30;
                break;
            case "otimo":
                $pontos = 40;
                break;
        }
         break;
 }


 $sql = "SELECT * FROM usuario WHERE cpf = $guardaCpf"; // Supondo que você esteja selecionando com base no ID 1
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    // Adiciona algo à linha selecionada
    $row = $result->fetch_assoc();
    $pontosAtuais = $row["pontos"]; // Adicionando algo ao campo existente

    $pontos = $pontos * $qtdPecas;
    $pontos = $pontos + $pontosAtuais;
    
    // Atualiza a linha com os novos dados
    $sql = "UPDATE usuario SET pontos = '$pontos' WHERE cpf = $guardaCpf"; // Atualizando com base no ID 1
    if ($conexao->query($sql) === TRUE) {
        header('refresh:1.5;admin.php');
      
        
    } else {
        echo "Erro ao atualizar o registro: " . $conexao->error;
    }
} else {
    echo "0 resultados";
}




             
 


        // Faça o que quiser com os valores aqui
        
        
  

        
        

                 
    
$sql = "SELECT * FROM doacao WHERE id = $guardaID"; // Supondo que você esteja selecionando com base no ID 1
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    // Adiciona algo à linha selecionada
    $row = $result->fetch_assoc();
    $id = $guardaID; 
    
}

$sql = "SELECT * FROM doacao WHERE id = $id"; // Supondo que você esteja selecionando com base no ID 1
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $quantidadeDoacao = $row['quantidade'];
    
}

$quantidadeDoacao = $quantidadeDoacao - $qtdPecas;

if($quantidadeDoacao >= 1){
    $sql = "UPDATE doacao SET quantidade = '$quantidadeDoacao' WHERE id = $id"; // Atualizando com base no ID 1
    if ($conexao->query($sql) === TRUE) {
       
        ?>
    <!DOCTYPE html>
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
                    
                                
                    
                    swal("Doacão feita com sucesso", "", "success");
                            </script>
                           
                            
                        </body>
                        </html><?php
        
    } else {
        echo "Erro ao atualizar o registro: " . $conexao->error;
    }
}else{

$sql = "DELETE FROM doacao WHERE id = $id";

if ($conexao->query($sql) === true) {
    ?>
    <!DOCTYPE html>
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
                    
                                
                    
                    swal("Doacão feita com sucesso", "", "success");
                            </script>
                           
                            
                        </body>
                        </html><?php
        header('refresh:1.5;admin.php');
} else {
    echo "Erro ao apagar a linha: " . $conexao->error;
}


    }} }

 ?>