<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Agência de viagens">
  <meta name="author" content="Tiago Cabaça">

  <title>Utilizadores - Backoffice - Voar Mais Alto</title>

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
    <h1 class="h3 mb-3">Utilizadores</h1>
    <?php mostrar_mensagem(); ?>

    <p><a href="inserirUtilizadores.php" class="btn btn-primary">Novo utilizador</a></p>

    <div class="table-responsive">
      <table class="table table-bordered table-sm table-hover">
        <thead class="thead-light">
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Morada</th>
            <th>Telefone</th>
            <th>Tipo</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $login = $conexao->query("Select * from login order by id ASC");
            if ($login->num_rows > 0) {
              while ($p = $login->fetch_assoc()) {
                $morada = trim((string)$p['morada']) === '' ? '-' : e($p['morada']);
                $telefone = trim((string)$p['telefone']) === '' ? '-' : e($p['telefone']);
                $tipo = ($p['tipo'] === 'admin') ? 'Administrador' : 'Utilizador';
                echo '
                <tr>
                  <td>'.e($p['utilizador']).'</td>
                  <td>'.e($p['email']).'</td>
                  <td>'.$morada.'</td>
                  <td>'.$telefone.'</td>
                  <td>'.$tipo.'</td>
                </tr>';
              }
            } else {
              echo '<tr><td colspan="5" class="text-center">Não existem utilizadores.</td></tr>';
            }
            $conexao->close();
          ?>
        </tbody>
      </table>
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
