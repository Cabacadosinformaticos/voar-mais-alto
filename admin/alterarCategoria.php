<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Agência de viagens">
  <meta name="author" content="Tiago Cabaça">

  <title>Editar destino - Backoffice - Voar Mais Alto</title>

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/shop-homepage.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>

<body>
<?php
  include '../db/config.php';
  $pagina_ativa = 'listaCategorias.php';
  include 'menu.php';
?>

  <!-- Page Content -->
  <div class="container mt-4">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <h1 class="h3 mb-3">Editar destino</h1>
        <?php mostrar_mensagem(); ?>

        <?php
          $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
          $stmt = mysqli_prepare($conexao, "Select * from categoria where CategoriaID = ?");
          mysqli_stmt_bind_param($stmt, 'i', $id);
          mysqli_stmt_execute($stmt);
          $categoria = mysqli_stmt_get_result($stmt);
          $p = ($categoria->num_rows > 0) ? mysqli_fetch_assoc($categoria) : null;
          mysqli_stmt_close($stmt);

          if ($p === null) {
            echo '<div class="alert alert-danger">Destino não encontrado.</div>';
            echo '<a href="listaCategorias.php" class="btn btn-secondary">Voltar</a>';
          } else {
        ?>
        <form action="alteraCategoria.php?id=<?=(int)$id;?>" method="post">
          <input type="hidden" name="csrf_token" value="<?=e(csrf_token());?>">
          <div class="form-group">
            <label for="categoria">Nome do destino</label>
            <input type="text" id="categoria" name="categoria" class="form-control" value="<?=e($p['CategoriaNome']);?>" required>
          </div>

          <button type="submit" class="btn btn-primary">Guardar alterações</button>
          <a href="listaCategorias.php" class="btn btn-secondary">Cancelar</a>
        </form>
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="py-5 bg-dark mt-4">
    <div>
      <p class="m-0 text-center text-white">Copyright &copy; Voar Mais Alto 2021</p>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
