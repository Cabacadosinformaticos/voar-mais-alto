<?php
   session_start();
   include("db/config.php");
   if (empty($_POST['post_email']) OR empty($_POST['post_password'])) {
    $msg = "Insira o utilizador e password";
    echo "<script>window.location = 'index.php?msg=" . urlencode($msg) . "'</script>"; exit;
   }
	$myemail = $_POST['post_email'];
    $mypassword =  $_POST['post_password'];

     $stmt = mysqli_prepare($conexao, "SELECT * FROM login WHERE email=?");
     mysqli_stmt_bind_param($stmt, 's', $myemail);
     mysqli_stmt_execute($stmt);
     $resultado = mysqli_stmt_get_result($stmt);

      if ($resultado && mysqli_num_rows($resultado) > 0) {
           $r = mysqli_fetch_assoc($resultado);
           if (password_verify($mypassword, $r['password'])) {
               session_regenerate_id(true);
               $_SESSION['utilizador'] = $r['utilizador'];
			   $_SESSION['idutilizador'] = $r['id'];
			   $_SESSION['tipo'] = $r['tipo'];
               if ( $r['tipo']=='admin') {
                   header('location:admin/listaProdutos.php');
                   exit;
               } else {
                   header('location:index.php');
                   exit;
               }
           }
      }
      mysqli_stmt_close($stmt);
      $msg = "Utilizador e/ou password incorretos ";
      echo "<script>window.location = 'index.php?msg=" . urlencode($msg) . "'</script>";exit;
?>
