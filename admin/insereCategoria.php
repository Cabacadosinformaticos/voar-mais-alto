<?php
      session_start();
      include '../db/config.php';
		  
	 if (isset($_SESSION['utilizador']) && $_SESSION['tipo'] == "admin" ){	
        echo "Utilizador válido";
     }else{
		 header('location:../index.php');
	 }	 
		 
      $nome = $_POST['categoria'];

       $sql = "Insert into categoria (CategoriaNome) values ('$nome')";
       $resultado = $conexao->query($sql);

       if($resultado){
        $msg="Registo inserido";
       }else{
           $msg="Erro ao inserir registo";
       } 

       echo "<script> window.location='listaCategorias.php?msg=$msg'; </script>";

       $conexao ->close();
?>