<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Agência de viagens">
  <meta name="author" content="Tiago Cabaça">

  <title>Destinos - Backoffice - Voar Mais Alto</title>

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
    <h1 class="h3 mb-3">Destinos</h1>
    <?php mostrar_mensagem(); ?>

    <p><a href="inserirCategorias.php" class="btn btn-primary">Novo destino</a></p>

    <div class="table-responsive">
      <table class="table table-bordered table-sm table-hover">
        <thead class="thead-light">
          <tr>
            <th>Destino</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $categorias = $conexao->query("Select * from categoria order by categoriaID ASC");
            if ($categorias->num_rows > 0) {
              while ($p = $categorias->fetch_assoc()) {
                echo '
                <tr>
                  <td>'.e($p['CategoriaNome']).'</td>
                  <td class="text-nowrap">
                    <a href="alterarCategoria.php?id='.(int)$p['CategoriaID'].'" class="btn btn-sm btn-primary">Editar</a>
                    <form action="eliminarCategoria.php" method="post" onsubmit="return confirm(\'Tem a certeza que deseja eliminar o registo?\');" style="display:inline;">
                      <input type="hidden" name="csrf_token" value="'.e(csrf_token()).'">
                      <input type="hidden" name="id" value="'.(int)$p['CategoriaID'].'">
                      <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                  </td>
                </tr>';
              }
            } else {
              echo '<tr><td colspan="2" class="text-center">Não existem destinos.</td></tr>';
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
