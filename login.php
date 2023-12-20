<?php

include_once('config.php');
    session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    // Acessa o sistema
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    // echo 'Email: ' . $email . '<br>';
    // echo 'Senha: ' . $senha;

    $sql = "SELECT * FROM usuario WHERE email = '$email'";
   
    $result = $conexao->query($sql);
   $admin = $result->fetch_assoc();
   $hash = $admin['senha'];
    // print_r($sql);
    //print_r($result);
       
    if(password_verify($senha, $hash) == false) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        ?> <!DOCTYPE html>
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
    
                
    
    swal("Login ou Senha incorretos", "tente novamente", "error");
            </script>
           
            
        </body>
        </html> <?php
        header('refresh:1.5;url=login.html');
    } else {  
         if(strpos($admin['email'], '@adminmodadobem') !== false){
            $_SESSION['email'] = $email; 

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
   
               
   
   swal("logado com sucesso", "Bem Vindo administrador!", "success");
           </script>
          
           
       </body>
       </html>
            <?php
            header('refresh:1.5;url=admin.php'); 
    }else{
         
        $sql = $conexao->prepare("SELECT verificacao FROM usuario WHERE email = ?");
        $sql->bind_param('s', $email); // 's' indica que $email é uma string
        $sql->execute();
        $result = $sql->get_result();
    
        $row = $result->fetch_assoc();
        $verificar = $row['verificacao'];
        $sql->close();


        $sql = $conexao->prepare("SELECT id FROM usuario WHERE email = ?");
        $sql->bind_param('s', $email); // 's' indica que $email é uma string
        $sql->execute();
        $result = $sql->get_result();
    
        $row = $result->fetch_assoc();
        $id = $row['id'];
    
        $_SESSION['id'] = $id;
    
        $sql->close();

        if($verificar == 1){

        


        
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;

        $sql = $conexao->prepare("SELECT id FROM usuario WHERE email = ?");
        $sql->bind_param('s', $email); // 's' indica que $email é uma string
        $sql->execute();
        $result = $sql->get_result();
    
        $row = $result->fetch_assoc();
        $id = $row['id'];
    
        $_SESSION['id'] = $id;
    
        $sql->close();
        

       ?> <!DOCTYPE html>
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
   
               
   
   swal("logado com sucesso", "Bem Vindo!", "success");
           </script>
          
           
       </body>
       </html>
       <?php
  
   
        header('refresh:1.5;url=indexLogin.php'); }
        else{
            ?> <!DOCTYPE html>
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
        
                    
        
        swal("Confirme seu email!", "", "info");
                </script>
               
                
            </body>
            </html>
            <?php
             $_SESSION['emailverificar'] = $email;
            header('refresh:1.5;url=emailVerifica1.php');
        }
    }
    }

} else {
    // Não acessa
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
   
               
   
   swal("logado com sucesso", "Bem Vindo!", "error");
           </script>
          
           
       </body>
       </html>
    
    
    <?php
    header('Location: login.html');
    exit();
}

?>

