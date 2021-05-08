<?php
  include '../db/config.php';
  $id = $_GET['id'];

  $sql = "delete from login where id='$id'";
  $resultado = $conexao->query($sql);
  if ($resultado){
      $msg = "Registo eliminado!";
  }else{
       $msg = "Erro ao eliminar registo";
  }
  echo" <script> window.location ='listaUtilizadores.php?msg=$msg' </script>";
  $conexao -> close();
?>