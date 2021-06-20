<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Agência de viagens">
  <meta name="author" content="Tiago Cabaça">

  <title>Novo destino - Backoffice - Voar Mais Alto</title>

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
        <h1 class="h3 mb-3">Novo destino</h1>
        <?php mostrar_mensagem(); ?>

        <form action="insereCategoria.php" method="post">
          <input type="hidden" name="csrf_token" value="<?=e(csrf_token());?>">
          <div class="form-group">
            <label for="categoria">Nome do destino</label>
            <input type="text" id="categoria" name="categoria" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary">Inserir</button>
          <a href="listaCategorias.php" class="btn btn-secondary">Cancelar</a>
        </form>

        <h2 class="h5 mt-4">Destinos já existentes</h2>
        <ul class="list-group">
          <?php
            $cats = $conexao->query("Select * from categoria order by CategoriaNome");
            if ($cats->num_rows > 0) {
              while ($c = $cats->fetch_assoc()) {
                echo '<li class="list-group-item">'.e($c['CategoriaNome']).'</li>';
              }
            }
          ?>
        </ul>
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
