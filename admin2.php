<?php

 
include('config.php');
session_start();

$email = $_SESSION['email'];

 if(strpos($_SESSION['email'] = $email, '@adminmodadobem') !== false){
    $_SESSION['email'] = $email;
     
}else{ header('location: login.html');}
 


$guardaCpf = $_SESSION['guardaCpf'];

         
             
             $sql_code = "SELECT * 
                 FROM doacao 
                 WHERE cpfUsuario = '%$guardaCpf%' ";
             $sql_query = $conexao->query($sql_code) or die("ERRO ao consultar! " . $conexao->error); 
             
             if ($sql_query->num_rows == 1) {
        ?>
             
             <?php
             } else {
                 if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                     
                 if (isset($_POST["parametro"])) {
        
        $id = $_POST["parametro"];
        

         $_SESSION['guardaID'] = $id;

        // Faça o que quiser com os valores aqui
        
        
  

        $sql = "SELECT * FROM doacao WHERE id = $id";
        $sql_query = $conexao->query($sql) or die("ERRO ao consultar! " . $conexao->error); 
        $dados = $sql_query->fetch_assoc(); 
        
        $estadoRoupa = $dados['EstadoRoupa'];
        $tipoRoupa = $dados['tipoRoupa'];
        $quantidadeRoupa = $dados['quantidade'];
        $idUsuario = $dados['idUsuario'];
        
        ?>
 

 <?php





 // Saída: 456


     // Consulta para buscar o ID do usuário
     $sql = $conexao->prepare("SELECT nome FROM usuario WHERE  id = ?");
     $sql->bind_param('i', $idUsuario); // 's' indica que $guardaCpf é um número inteiro
     $sql->execute();
     $result = $sql->get_result();
     
     if ($result->num_rows === 1) {
         $row = $result->fetch_assoc();
         $nomeUsuario = $row['nome']; // Obtém o valor 'id' do resultado da consulta
     } else {
         // Ocorreu um erro. Confira se os campos estão corretos.
         echo var_dump($cpfUsuario);
         echo "Ocorreu um erro. Confira se os campos estão corretos.";
         exit;
     }
 
     $sql->close(); // Feche a primeira consulta preparada
 


 
 ?>
 <!DOCTYPE html>
 <html lang="pt-br">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="stylesheet" href="css/style.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>MDB - Admin</title>

     <style>
        .imageAviso{
            display: flex;
            align-items: center;
            justify-content: center;
        }
     </style>
 </head>
 <header>
        <nav class="navAdmin">
            <img src="images/logo-branca.png" alt="Logo Moda do Bem" class="logo">
        </nav>
    </header>

 <body>
          
         
    
            
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">doacao concluida</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <img class="imageAviso" src="images/verificado.gif" width="150px" height="150px" alt="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>




            <div class="center">
                <main class="telaAdmin2">
                    <h1> <?php echo $nomeUsuario; ?>  </h1>

                    <form action="admin3.php" method="post">
                        <select name="selectEstadoRoupa" id="selectEstadoRoupa" required>
                                <option disabled >Selecione o estado da roupa</option>
                                <option value="bom" <?php if($estadoRoupa == "Bom")  echo 'selected'; ?> >Bom</option>
                                <option value="otimo" <?php if($estadoRoupa == "Otimo")  echo'selected'; ?> >Ótimo</option>
                                <option value="ruim" <?php if($estadoRoupa == "Ruim")  echo 'selected'; ?> >Ruim</option>
                                <option value="regular" <?php if($estadoRoupa == "Regular")  echo 'selected'; ?> >Regular</option>
                            </select> 
                           
                            <br>
                            <br>
                            <br>
                            <select name="selectTipoRoupa" id="selectTipoRoupa" required>
                                <option disabled >Selecione o tipo da roupa:</option>
                                <option value="calcas" <?php if($tipoRoupa == "Calcas")  echo 'selected'; ?>>Calças</option>
                                <option value="moletons" <?php if($tipoRoupa == "Moletons")  echo 'selected'; ?>>Jaquetas/Moletons</option>
                                <option value="vestidos" <?php if($tipoRoupa == "Vestidos")  echo 'selected'; ?>>Vestidos</option>
                                <option value="camisetas" <?php if($tipoRoupa == "Camisetas")  echo 'selected'; ?>>camisetas</option>

                            </select>

                            <br>
                            <br>
                            <br>
                            <input type="number" name="qtdPecas" value="<?php echo $quantidadeRoupa; ?>" required>
                            <br>
                            <br>
                            <input type="hidden" name="parametroId" value="<?php $id; ?>">
                            <input type="submit"  value="Enviar" name="submit">
                            
                            </form>
                    
                

                </main>
            </div>
                        <?php 
                    }
                }}
                
                
                ?>
            <?php
            $_SESSION['guardaID'];
            ?>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
 </body>
 </html>


 
