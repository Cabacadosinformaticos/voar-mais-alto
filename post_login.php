<?php
   session_start();
   include("db/config.php");   
   if (empty($_POST['post_email']) OR empty($_POST['post_password'])) {
    $msg = "Insira o utilizador e password";
    echo "<script>window.location = 'index.php?msg=$msg'</script>"; exit;
   }
     //$myusername = $_POST['uname'];
	$myemail = $_POST['post_email'];
    $mypassword =  $_POST['post_password'];
     
     $sql = "SELECT * FROM login WHERE email='$myemail' AND password='$mypassword'" ;
       
     $resultado = $conexao->query($sql);  
     	 
      if ($resultado->num_rows > 0) {      
           $r = $resultado->fetch_assoc();     
           $_SESSION['utilizador'] = $r['utilizador'];
		   $_SESSION['idutilizador'] = $r['id'];		  
		   $_SESSION['tipo'] = $r['tipo']; 		   
           header('location:index.php');		   
      }else {
           $msg = "Utilizador e/ou password incorretos ";
           echo "<script>window.location = 'index.php?msg=$msg'</script>";exit;
      } 
      if ( $r['tipo']=='admin') {
       header('location:admin/listaProdutos.php');
      } else {
      header('location:index.php');
      }      
?>