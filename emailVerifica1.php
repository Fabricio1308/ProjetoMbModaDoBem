
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/logo-azul.png" type="icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Moda do Bem</title>
  </head>
  <style>
    body, html {
  height: 100%;
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}
    .center{
     
      display: flex;
      justify-content: center;
      text-align: center;
      align-items: center;
      width: 10rem;
      height: 10rem;
      padding: 10rem;
      background-color: white;
      color:  black;
      border-radius: 2rem;
    }

    .center h4{
      width: 15rem;
      font-size: 1.6rem;
      color: #2160a9;
    }

    .center input{
      margin-top: 3rem;
      padding: 1.3rem;
      border: solid 3px #2160a9;
      border-radius: 1rem;
      cursor: pointer;

    }

    

    

  </style>
  <body>

  <div class="center">
  
      <form action="emailVerifica.php" id="enviarEmail" class="enviarEmail" method="post">
        <h4>enviar codigo de verificação para o email:</h4>
      <input type="hidden" name="codigo" value="<?php echo $numero_aleatorio = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); ?>">
      <input type="submit" onclick="mostrarDiv()" value="enviar para o email" >
      </form>

   

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 
  </body>
</html>