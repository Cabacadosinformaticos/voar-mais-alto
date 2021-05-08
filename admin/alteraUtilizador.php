<?php
      session_start();
      include '../db/config.php';
	  if (isset($_SESSION['utilizador']) && $_SESSION['tipo'] == "admin" ){	
        echo "Utilizador válido";
     }else{
		 header('location:../index.php');
	 }	 
	   $nome = $_POST['nome'];
       $email = $_POST['email'];
       $morada = $_POST['morada'];
       $telefone = $_POST['telefone'];
       $password = $_POST['password'];
       $tipo = $_POST['tipo'];
	   $id = $_GET['id'];

       $sql = "update login set utilizador='$nome',email='$email',morada='$morada',telefone='$telefone',password='$password',tipo='$tipo' where id='$id'";
       $resultado = $conexao->query($sql);

       if($resultado){
        $msg="Registo alterado";
       }else{
           $msg="Não foi possível alterar o registo";
       } 

     echo "<script> window.location = 'listaUtilizadores.php?msg=$msg';</script>";

       $conexao ->close();
?>