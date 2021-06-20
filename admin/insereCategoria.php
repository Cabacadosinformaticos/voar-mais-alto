<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<?php
      include '../db/config.php';

      csrf_check();

      $nome = $_POST['categoria'];

       $stmt = mysqli_prepare($conexao, "Insert into categoria (CategoriaNome) values (?)");
       mysqli_stmt_bind_param($stmt, 's', $nome);
       $resultado = mysqli_stmt_execute($stmt);
       mysqli_stmt_close($stmt);

       if($resultado){
        $msg="Registo inserido";
       }else{
           $msg="Erro ao inserir registo";
       }

  header('Location: listaCategorias.php?msg='.urlencode($msg)); exit;

       $conexao ->close();
?>
