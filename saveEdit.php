<?php

    include_once('config.php');

    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        $update = $conexao->prepare("UPDATE `usuario` SET `nome`=?, `email`=?, `cpf`=?, `senha`=? WHERE id = ?");
        $update->bind_param('ssisi', $nome, $email, $cpf, $senha, $id);
        $foi = $update->execute();

        $_SESSION['id'] = $id;
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['cpf'] = $cpf;
        $_SESSION['senha'] = $senha;

    }
    header('Location: telaDePerfil.php');

?>