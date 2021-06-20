<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Agência de viagens">
  <meta name="author" content="Tiago Cabaça">

  <title>Novo utilizador - Backoffice - Voar Mais Alto</title>

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
  $pagina_ativa = 'listaUtilizadores.php';
  include 'menu.php';
?>

  <!-- Page Content -->
  <div class="container mt-4">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <h1 class="h3 mb-3">Novo utilizador</h1>
        <?php mostrar_mensagem(); ?>

        <form action="insereUtilizador.php" method="post">
          <input type="hidden" name="csrf_token" value="<?=e(csrf_token());?>">
          <div class="form-group">
            <label for="nome">Nome do utilizador</label>
            <input type="text" id="nome" name="nome" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="morada">Morada</label>
            <input type="text" id="morada" name="morada" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="tel" id="telefone" name="telefone" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="password">Palavra-passe</label>
            <input type="password" id="password" name="password" class="form-control" minlength="6" required>
            <small class="form-text text-muted">Mínimo de 6 caracteres.</small>
          </div>
          <div class="form-group">
            <label for="tipo">Tipo de conta</label>
            <select id="tipo" name="tipo" class="form-control">
              <option value="user">Utilizador normal</option>
              <option value="admin">Administrador</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Inserir</button>
          <a href="listaUtilizadores.php" class="btn btn-secondary">Cancelar</a>
        </form>
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
