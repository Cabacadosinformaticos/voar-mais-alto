<?php
      session_start();
      include 'db/config.php';

      if (!isset($_SESSION['idutilizador'])) {
          header('Location: index.php');
          exit;
      }

      if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['idproduto'])) {
          header('Location: index.php');
          exit;
      }

      csrf_check();

      $idutilizador = (int)$_SESSION['idutilizador'];
      $idproduto =    (int)$_POST['idproduto'];
      $qte =  isset($_POST['qte']) ? (int)$_POST['qte'] : 1;
      $checkin =    isset($_POST['checkin']) ? $_POST['checkin'] : '';
      $checkout =    isset($_POST['checkout']) ? $_POST['checkout'] : '';
      $quartos =    isset($_POST['quartos']) ? (int)$_POST['quartos'] : 1;
      $adultos =    isset($_POST['adultos']) ? (int)$_POST['adultos'] : 1;
      $criancas =    isset($_POST['criancas']) ? (int)$_POST['criancas'] : 0;

      $stmt = mysqli_prepare($conexao, "Insert into carrinho (idutilizador,idproduto,checkin,checkout,quartos,adultos,criancas,qte) values (?,?,?,?,?,?,?,?)");
      mysqli_stmt_bind_param($stmt, 'iissiiii', $idutilizador, $idproduto, $checkin, $checkout, $quartos, $adultos, $criancas, $qte);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

      $stmtStock = mysqli_prepare($conexao, "Update produto set stock = stock - 1 where produtoID=? and stock > 0");
      mysqli_stmt_bind_param($stmtStock, 'i', $idproduto);
      mysqli_stmt_execute($stmtStock);
      mysqli_stmt_close($stmtStock);

      $msg = "Compra registada com sucesso";
      echo "<script> window.location='index.php?msg=" . urlencode($msg) . "'; </script>";

      $conexao ->close();
?>
