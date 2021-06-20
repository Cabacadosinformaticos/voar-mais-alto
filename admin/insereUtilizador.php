<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<?php
      include '../db/config.php';

      csrf_check();

      $nome = $_POST['nome'];
      $email = trim($_POST['email']);
      $morada = $_POST['morada'];
      $telefone = $_POST['telefone'];
      $password_plana = $_POST['password'];
      $tipo = $_POST['tipo'];

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $msg = "Insira um email válido";
  header('Location: listaUtilizadores.php?msg='.urlencode($msg)); exit;
          $conexao ->close();
          exit;
      }

      if (strlen($password_plana) < 6) {
          $msg = "A password deve ter pelo menos 6 caracteres";
  header('Location: listaUtilizadores.php?msg='.urlencode($msg)); exit;
          $conexao ->close();
          exit;
      }

      // Verificar se o email já está registado.
      $check = mysqli_prepare($conexao, "SELECT id FROM login WHERE email=?");
      mysqli_stmt_bind_param($check, 's', $email);
      mysqli_stmt_execute($check);
      mysqli_stmt_store_result($check);
      if (mysqli_stmt_num_rows($check) > 0) {
          mysqli_stmt_close($check);
          $msg = "Já existe um registo com este email";
  header('Location: listaUtilizadores.php?msg='.urlencode($msg)); exit;
          $conexao ->close();
          exit;
      }
      mysqli_stmt_close($check);

      $password = password_hash($password_plana, PASSWORD_DEFAULT);

      $stmt = mysqli_prepare($conexao, "Insert into login (utilizador,email,morada,telefone,password,tipo) values (?,?,?,?,?,?)");
      mysqli_stmt_bind_param($stmt, 'ssssss', $nome, $email, $morada, $telefone, $password, $tipo);
      $resultado = mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

       if($resultado){
        $msg="Registo inserido";
       }else{
           $msg="Erro ao inserir registo";
       }

  header('Location: listaUtilizadores.php?msg='.urlencode($msg)); exit;

       $conexao ->close();
?>
