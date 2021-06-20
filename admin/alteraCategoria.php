<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<?php
      include '../db/config.php';

       csrf_check();

       $id = (int)$_GET['id'];
       $categoria = $_POST['categoria'];

       $stmt = mysqli_prepare($conexao, "update categoria set CategoriaNome=? where categoriaID=?");
       mysqli_stmt_bind_param($stmt, 'si', $categoria, $id);
       $resultado = mysqli_stmt_execute($stmt);
       mysqli_stmt_close($stmt);

       if($resultado){
        $msg="Registo alterado";
       }else{
           $msg="Não foi possível alterar o registo";
       }

  header('Location: listaCategorias.php?msg='.urlencode($msg)); exit;

       $conexao ->close();
?>
