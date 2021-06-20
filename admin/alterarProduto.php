<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Agência de viagens">
  <meta name="author" content="Tiago Cabaça">

  <title>Editar viagem - Backoffice - Voar Mais Alto</title>

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
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <h1 class="h3 mb-3">Editar viagem</h1>
        <?php mostrar_mensagem(); ?>

        <?php
          $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
          $stmt = mysqli_prepare($conexao, "Select * from produto where produtoID=?");
          mysqli_stmt_bind_param($stmt, 'i', $id);
          mysqli_stmt_execute($stmt);
          $produtos = mysqli_stmt_get_result($stmt);
          $p = ($produtos->num_rows > 0) ? mysqli_fetch_assoc($produtos) : null;
          mysqli_stmt_close($stmt);

          if ($p === null) {
            echo '<div class="alert alert-danger">Viagem não encontrada.</div>';
            echo '<a href="listaProdutos.php" class="btn btn-secondary">Voltar</a>';
          } else {
        ?>
        <form action="alteraProduto.php?id=<?=(int)$id;?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="csrf_token" value="<?=e(csrf_token());?>">
          <div class="form-group">
            <label for="produto">Nome da viagem</label>
            <input type="text" id="produto" name="produto" class="form-control" value="<?=e($p['produtoNome']);?>" required>
          </div>
          <div class="form-group">
            <label for="categoria">Destino</label>
            <select id="categoria" name="categoria" class="form-control">
              <?php
                $categoria = $conexao->query("select * from categoria order by CategoriaNome");
                if ($categoria->num_rows > 0) {
                  while ($c = $categoria->fetch_assoc()) {
                    $selected = ($c['CategoriaID'] == $p['categoriaID']) ? ' selected' : '';
                    echo '<option value="'.(int)$c['CategoriaID'].'"'.$selected.'>'.e($c['CategoriaNome']).'</option>';
                  }
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="preco">Preço (&euro;)</label>
            <input type="number" id="preco" name="preco" class="form-control" step="0.01" min="0" value="<?=e($p['preco']);?>" required>
          </div>
          <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" class="form-control" min="0" value="<?=e($p['stock']);?>" required>
          </div>
          <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="6" required><?=e($p['descricao']);?></textarea>
          </div>
          <div class="form-group">
            <label for="imagem">Imagem</label>
            <?php if ($p['imagem'] != '') { ?>
              <div class="mb-2">
                <img src="<?=e($p['imagem']);?>" alt="<?=e($p['produtoNome']);?>" style="width:200px; height:auto;">
              </div>
            <?php } ?>
            <input type="file" id="imagem" name="imagem" accept="image/*" class="form-control-file">
            <small class="form-text text-muted">Deixe vazio para manter a imagem atual.</small>
          </div>

          <button type="submit" class="btn btn-primary">Guardar alterações</button>
          <a href="listaProdutos.php" class="btn btn-secondary">Cancelar</a>
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
