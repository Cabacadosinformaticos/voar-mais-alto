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

       $sql = "Insert into login (utilizador,email,morada,telefone,password,tipo) values ('$nome', '$email', '$morada', '$telefone','$password','$tipo')";
       $resultado = $conexao->query($sql);

       if($resultado){
        $msg="Registo inserido";
       }else{
           $msg="Erro ao inserir registo";
       } 

       echo "<script> window.location='listaUtilizadores.php?msg=$msg'; </script>";

       $conexao ->close();
?>