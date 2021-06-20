<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Agência de viagens">
  <meta name="author" content="Tiago Cabaça">

  <title>Vendas - Backoffice - Voar Mais Alto</title>

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
  $pagina_ativa = 'listaProdutosVendidos.php';
  include 'menu.php';
?>

  <!-- Page Content -->
  <div class="container mt-4">
    <h1 class="h3 mb-3">Vendas</h1>
    <?php mostrar_mensagem(); ?>

    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <div class="table-responsive">
          <table class="table table-bordered table-sm table-hover">
            <thead class="thead-light">
              <tr>
                <th>Cliente</th>
                <th>Viagem</th>
                <th>Entrada</th>
                <th>Saída</th>
                <th>Preço</th>
                <th>Qtd</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql = "select carrinho.id as id, login.utilizador as utilizador, produto.preco as preco, produto.produtoNome as nome, carrinho.qte as qte, carrinho.checkin as checkin, carrinho.checkout as checkout from carrinho inner join produto on carrinho.idproduto = produto.produtoID inner join login on login.id = carrinho.idutilizador";
                $produtos = $conexao->query($sql);
                if ($produtos->num_rows > 0) {
                  while ($p = $produtos->fetch_assoc()) {
                    $total = (float)$p['preco'] * (int)$p['qte'];
                    echo '
                    <tr>
                      <td>'.e($p['utilizador']).'</td>
                      <td>'.e($p['nome']).'</td>
                      <td class="text-nowrap">'.formatar_data($p['checkin']).'</td>
                      <td class="text-nowrap">'.formatar_data($p['checkout']).'</td>
                      <td class="text-nowrap">'.number_format((float)$p['preco'], 2, ',', '.').' &euro;</td>
                      <td>'.(int)$p['qte'].'</td>
                      <td class="text-nowrap">'.number_format($total, 2, ',', '.').' &euro;</td>
                    </tr>';
                  }
                } else {
                  echo '<tr><td colspan="7" class="text-center">Ainda não existem vendas.</td></tr>';
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
