<?php
 

 include_once('config.php');
 session_start();
 $email = $_SESSION['email'];
 if(strpos($_SESSION['email'] = $email, '@adminmodadobem') !== false){
    $_SESSION['email'] = $email;
     
}else{ header('location: login.html');}
 ?>
 <!DOCTYPE html>
 <html lang="pt-br">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/style.css">
     <title>MDB - Admin</title>
 </head>
 <body>
    <header>
        <nav class="navAdmin">
            <img src="images/logo-branca.png" alt="Logo Moda do Bem" class="logo">
        </nav>
    </header>
    <div class="center">
        <main class="telaAdmin">
            <form action="" method="get">
                <div class="pesquisaAdmin">
                    <input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite o CPF do doador" type="text"  maxLength="11">
                    <button type="submit"><img src="images/lupa-pesquisa.png" alt="Pesquisar" title="Pesquisar"></button>
                </div>
                <h1>Lista de doações</h1>
                
            </form>
            <!-- <br>
            <table width="600px" border="1">
                <tr>
                    <th>CPF Usuario</th>
                    <th>tipo Roupa</th>
                    <th>Estado Roupa</th>
                    <th>Local</th>
                    <th>quantidade</th>
                    <th>Veja mais</th>
                </tr> -->

            
                <div class="doacoesUsuario">

                    <?php
                    if($guardar = !isset($_GET['busca'])) {
                        ?>
                    <tr>
                        <td colspan="3">Digite algo para pesquisar...</td>
                    </tr>
                    <?php
                    } else {
                        $pesquisa = $conexao->real_escape_string($_GET['busca']);
                        $sql_code = "SELECT * 
                            FROM doacao 
                            WHERE cpfUsuario LIKE '%$pesquisa%' ";
                        $sql_query = $conexao->query($sql_code) or die("ERRO ao consultar! " . $conexao->error); 
                        
                        if ($sql_query->num_rows == 0) {
                            ?>
                        <tr>
                            <td colspan="3">Nenhum resultado encontrado...</td>
                        </tr>
                        <?php
                        } else {
                            while($dados = $sql_query->fetch_assoc()) {
                            
                              
                                
                                ?> 

                                
                                
  
  
 
                                <div class="divPesquisaDoacao">
                                 <form action="admin2.php" method="post">
                                    <h4 name="cpf" id="cpf" ><?php echo $dados['cpfUsuario']; ?></h4>
                                    <p><?php  echo $dados['tipoRoupa']; ?></p>
                                    <p><?php  echo $dados['EstadoRoupa']; ?></p>
                                    <p><?php echo $dados['pontoEntrega']; ?></p>
                                     
                                    <input type="hidden" name="parametro" value="<?php echo $dados['id']; ?>">
                                    
                                    <p name="quantidade">Quantidade: <?php echo $dados['quantidade']; ?></p>
                                    
                                    <input type="submit" value="Enviar">
                                   </form>
                        
                    
                                </div>
                                <?php
                                
                                $guardaCpf = $dados['cpfUsuario'];
                                $_SESSION['guardaCpf'] = $guardaCpf;
                               
                                
    
                            }
                        }
                        
                        
                        
                        ?>
                    <?php


                        
                    } ?>
                    <!-- </table> -->
                    <a href="sair.php" class="logoutAdmin">Sair</a>

                </div>
        </main>
    </div>
 </body>
 </html>