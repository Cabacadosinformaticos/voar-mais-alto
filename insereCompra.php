<?php
      session_start();
      include 'db/config.php';
		  
	  if (isset($_SESSION['utilizador']) && $_SESSION['tipo'] == "admin" ){	
        echo "Utilizador válido";
     }else{
		 header('location:index.php');
	 }	 
	  
      $idutilizador = $_SESSION['idutilizador'];
      //$idproduto =    $_GET['id'];
	  if (isset($_POST['idproduto'])){
		  $idproduto =    $_POST['idproduto'];
		  $qte =  $_POST["qte"];  // 1;		  
	  }else{
		  $idproduto =    $_GET['id'];
		  $qte =  1;
	  }
	  
	  $sql = "Insert into carrinho (idutilizador,idproduto,qte) values ('$idutilizador','$idproduto','$qte')";
      $resultado = $conexao->query($sql);

        echo "<script> window.location='index.php?msg=$msg'; </script>";

       $conexao ->close();
     

       
?>