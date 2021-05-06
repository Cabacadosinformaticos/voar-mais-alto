<?php
      session_start();
      include '../db/config.php';
	  if (isset($_SESSION['utilizador']) && $_SESSION['tipo'] == "admin" ){	
        echo "Utilizador válido";
     }else{
		 header('location:../index.php');
	 }	 
       $id = $_GET['id'];
       $categoria = $_POST['categoria'];
      
       $sql = "update categoria set CategoriaNome='$categoria' where categoriaID='$id'";
       $resultado = $conexao->query($sql);

       if($resultado){
        $msg="Registo alterado";
       }else{
           $msg="Não foi possível alterar o registo";
       } 

     echo "<script> window.location = 'listaCategorias.php?msg=$msg';</script>";

       $conexao ->close();
?>