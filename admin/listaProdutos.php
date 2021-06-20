<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Agência de viagens">
  <meta name="author" content="Tiago Cabaça">

  <title>Viagens - Backoffice - Voar Mais Alto</title>

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
  $pagina_ativa = 'listaProdutos.php';
  include 'menu.php';
?>

  <!-- Page Content -->
  <div class="container mt-4">
    <h1 class="h3 mb-3">Viagens</h1>
    <?php mostrar_mensagem(); ?>

    <div class="row">
      <div class="col-lg-2 mb-3">
        <h2 class="h5">Filtrar por destino</h2>
        <div class="list-group">
          <?php
            $idFiltro = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            echo '<a href="listaProdutos.php" class="list-group-item list-group-item-action'.($idFiltro === 0 ? ' active' : '').'">Todos</a>';
            $cats = $conexao->query("Select * from categoria order by CategoriaNome");
            if ($cats->num_rows > 0) {
              while ($c = $cats->fetch_assoc()) {
                $ativo = ($idFiltro === (int)$c['CategoriaID']) ? ' active' : '';
                echo '<a href="listaProdutos.php?id='.(int)$c['CategoriaID'].'" class="list-group-item list-group-item-action'.$ativo.'">'.e($c['CategoriaNome']).'</a>';
              }
            }
          ?>
        </div>
      </div>

      <div class="col-lg-10">
        <p><a href="inserirProdutos.php" class="btn btn-primary">Nova viagem</a></p>

        <div class="table-responsive">
          <table class="table table-bordered table-sm table-hover">
            <thead class="thead-light">
              <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Imagem</th>
                <th>Destino</th>
                <th>Stock</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if ($idFiltro > 0) {
                  $stmt = mysqli_prepare($conexao, "Select * from produto, categoria where produto.categoriaID = categoria.categoriaID and produto.categoriaID=?");
                  mysqli_stmt_bind_param($stmt, 'i', $idFiltro);
                  mysqli_stmt_execute($stmt);
                  $produtos = mysqli_stmt_get_result($stmt);
                } else {
                  $produtos = $conexao->query("Select * from produto, categoria where produto.categoriaID = categoria.categoriaID");
                }
                if ($produtos->num_rows > 0) {
                  while ($p = $produtos->fetch_assoc()) {
                    // Descrição cortada em palavras inteiras, cerca de 100 caracteres.
                    $desc = (string)$p['descricao'];
                    if (mb_strlen($desc) > 100) {
                      $desc = mb_substr($desc, 0, 100);
                      $pos = mb_strrpos($desc, ' ');
                      if ($pos !== false) {
                        $desc = mb_substr($desc, 0, $pos);
                      }
                      $desc = rtrim($desc, " .,;:!?-").'...';
                    }
                    echo '
                    <tr>
                      <td>'.e($p['produtoNome']).'</td>
                      <td class="text-nowrap">'.number_format((float)$p['preco'], 2, ',', '.').' &euro;</td>
                      <td>'.e($desc).'</td>
                      <td><img src="'.e($p['imagem']).'" alt="'.e($p['produtoNome']).'" style="width:100px; height:auto;"></td>
                      <td>'.e($p['CategoriaNome']).'</td>
                      <td>'.e($p['stock']).'</td>
                      <td class="text-nowrap">
                        <a href="alterarProduto.php?id='.(int)$p['produtoID'].'" class="btn btn-sm btn-primary">Editar</a>
                        <form action="eliminarProduto.php" method="post" onsubmit="return confirm(\'Tem a certeza que deseja eliminar o registo?\');" style="display:inline;">
                          <input type="hidden" name="csrf_token" value="'.e(csrf_token()).'">
                          <input type="hidden" name="id" value="'.(int)$p['produtoID'].'">
                          <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                      </td>
                    </tr>';
                  }
                } else {
                  echo '<tr><td colspan="7" class="text-center">Não existem viagens.</td></tr>';
                }
                $conexao->close();
              ?>
            </tbody>
          </table>
        </div>
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
