<?php
session_start();
include 'db/config.php';

if (!isset($_SESSION['idutilizador'])) {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: viagens.php');
    exit;
}
$id = (int)$_GET['id'];
$stmt = mysqli_prepare($conexao, "SELECT * FROM produto WHERE produtoID=?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$produtos = mysqli_stmt_get_result($stmt);
if ($produtos->num_rows == 0) {
    header('Location: viagens.php');
    exit;
}
$p = mysqli_fetch_assoc($produtos);
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Agencia de viagens">
  <meta name="author" content="Tiago Cabaça">

  <title>Agência de viagens - Voar Mais Alto</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

	<!-- Google font -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/finalizacao_compra.css" />

</head>

<body style="background-color:#ccddff">

  <div id="vendas" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-md-push-5">
						<div class="vendas-cta">
							<h1>Insira os dados para a reserva</h1>
							<p>Por favor, insira seguidamente os dados requisitados para poder seguir para o pagamento</p>
						</div>
					</div>
					<div class="col-md-4 col-md-pull-7">
						<div class="vendas-form">
							<form method="post" action="insereCompra.php" id="formReserva">
								<input type="hidden" name="csrf_token" value="<?=e(csrf_token());?>">
								<input type="hidden" name="idproduto" value="<?=(int)$p['produtoID'];?>">

								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="form-label" for="checkin">Entrada</label>
											<input class="form-control" id="checkin" name="checkin" type="date" min="<?=date('Y-m-d');?>" required>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="form-label" for="checkout">Saída</label>
											<input class="form-control" id="checkout" name="checkout" type="date" min="<?=date('Y-m-d', strtotime('+1 day'));?>" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="form-label" for="quartos">Quartos</label>
											<select id="quartos" name="quartos" class="form-control">

												<option value="1">1</option>
												<option value="2">2</option>

											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="form-label" for="adultos">Adultos</label>
											<select id="adultos" name="adultos" class="form-control">

												<option value="1">1</option>
												<option value="2">2</option>

											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="form-label" for="criancas">Crianças</label>
											<select id="criancas" name="criancas" class="form-control">

												<option value="0">0</option>
												<option value="1">1</option>
												<option value="2">2</option>

											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
								</div>
								<div class="form-btn">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Avançar para o pagamento</button>
									<a href="detalheProduto.php?id=<?=(int)$p['produtoID'];?>" class="btn btn-secondary">Voltar</a>


								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-body">
      <article class="card">
<div class="card-body p-5">

<ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
		<i class="fa fa-credit-card"></i> Cartão de crédito</a></li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
		<i class="fab fa-paypal"></i> Paypal</a></li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
		<i class="fa fa-university"></i> Transferência Bancária</a></li>
</ul>

<div class="tab-content">
<div class="tab-pane fade show active" id="nav-tab-card">
	<div class="form-group">
		<label for="username">Nome completo (que está no cartão)</label>
		<input type="text" class="form-control" name="username" placeholder="" required>
	</div> <!-- form-group.// -->

	<div class="form-group">
		<label for="cardNumber">Número do cartão</label>
		<div class="input-group">
			<input type="text" class="form-control" name="cardNumber" placeholder="" required>
			<div class="input-group-append">
				<span class="input-group-text text-muted">
					<i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>
					<i class="fab fa-cc-mastercard"></i>
				</span>
			</div>
		</div>
	</div> <!-- form-group.// -->

	<div class="row">
	    <div class="col-sm-8">
	        <div class="form-group">
	            <label><span class="hidden-xs">Data de validade</span> </label>
	        	<div class="input-group">
	        		<input type="number" class="form-control" placeholder="MM" name="" required>
		            <input type="number" class="form-control" placeholder="YY" name="" required>
	        	</div>
	        </div>
	    </div>
	    <div class="col-sm-4">
	        <div class="form-group">
	            <label data-toggle="tooltip" title="" data-original-title="Código de 3 dígitos no verso do cartão">CVV <i class="fa fa-question-circle"></i></label>
	            <input type="number" class="form-control" required>
	        </div> <!-- form-group.// -->
	    </div>
	</div> <!-- row.// -->
	<?php
	if (isset($_SESSION['idutilizador'])){
    echo '<button type="submit" form="formReserva" class="subscribe btn btn-primary btn-block"> Comprar </button>';
	}
	?>
</div> <!-- tab-pane.// -->
<div class="tab-pane fade" id="nav-tab-paypal">
<p><center>Paypal é a maneira mais fácil de pagar online</center></p>
<br>
<p><a href="index.php"><center><button type="button" class="btn btn-primary"> <i class="fab fa-paypal"></i> Entrar no meu Paypal </button></center></a></p>
<br></br>
<p><strong>Observação:</strong> Após clicar no botão, você será redirecionado para o sistema do Paypal para se autenticar e confirmar o pagamento. </p>
</div>
<div class="tab-pane fade" id="nav-tab-bank">
<p>Detalhes da conta bancária</p>
<dl class="param">
  <dt>BANCO: </dt>
  <dd> WOOHP </dd>
</dl>
<dl class="param">
  <dt>Número da conta: </dt>
  <dd> 43314112527415</dd>
</dl>
<dl class="param">
  <dt>IBAN: </dt>
  <dd> 782555859</dd>
</dl>
<p><strong>Observação:</strong> Observe que leva cerca de 3 a 7 dias para processar a sua transferência bancária, embora às vezes possa demorar mais.</p>
<a href="index.php"><button  class="subscribe btn btn-primary btn-block" type="button"> Voltar para a Página Inicial </button></a>
</div> <!-- tab-pane.// -->
</div> <!-- tab-content .// -->
</div> <!-- card-body.// -->
</article> <!-- card.// -->


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>

	<!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
