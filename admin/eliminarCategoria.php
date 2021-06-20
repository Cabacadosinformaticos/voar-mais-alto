<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<?php
  include '../db/config.php';

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: listaCategorias.php');
      exit;
  }

  csrf_check();

  $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

  $stmt = mysqli_prepare($conexao, "delete from categoria where CategoriaID=?");
  mysqli_stmt_bind_param($stmt, 'i', $id);
  $resultado = mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  if ($resultado){
      $msg = "Registo eliminado!";
  }else{
       $msg = "Erro ao eliminar registo";
  }
  header('Location: listaCategorias.php?msg='.urlencode($msg)); exit;
  $conexao -> close();
?>
