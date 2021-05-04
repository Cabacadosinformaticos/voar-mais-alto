<?php
  include '../db/config.php';
  $id = $_GET['id'];

  $sql = "delete from produto where produtoID='$id'";
  $resultado = $conexao->query($sql);
  if ($resultado){
      $msg = "Registo eliminado!";
  }else{
       $msg = "Erro ao eliminar registo";
  }
  echo" <script> window.location ='listaProdutos.php?msg=$msg' </script>";
  $conexao -> close();
?>