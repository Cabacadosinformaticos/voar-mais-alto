<?php
session_start();
include 'db/config.php';

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

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.php"><span>Voar Mais Alto</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li class="drop-down active"><a href="viagens.php">Viagens</a>
            <ul>
                <?php
                $sql = "Select * from categoria";
                $cats =$conexao->query($sql);
                if ($cats->num_rows >0) {
                  while ($c = $cats->fetch_assoc()){
                    $cat=$c['CategoriaID'];
                  echo'<li><a href="viagens.php?id='.(int)$c['CategoriaID'].'"><center>'.e($c['CategoriaNome']).'</center></a></li>';
                  }
                }
				?>
			</ul>
          </li>
          <li><a href="servicos.php">Serviços</a></li>
          <li><a href="sobrenos.php">Sobre Nós</a></li>
          <li><a href="#footer">Contactos</a></li>
		  
		  <?php
		  if (isset($_SESSION['utilizador'])){
			  echo '<li class="drop-down"><a><i class="fa fa-user-alt"></i> '.e($_SESSION['utilizador']).'</a>
					<ul>
					<li><a class="nav-link" href="post_logout.php" style="color:red;"><center>Sair</center></a></li>
					</ul>
					</li>';
		  }else{
			  echo '<li class="nav-item"><a class="nav-link" href="#modallogin" data-toggle="modal" data-target="#modallogin"><i class="fa fa-user-alt"></i></a></li>';
		  }	  
		  ?>
		  
		  <?php
		  //echo $_SESSION['utilizador'];
		  if (isset($_SESSION['utilizador'])){
			  
			if($_SESSION['tipo']=='admin')
			{
                echo '<li class="nav-item"><a class="nav-link" href="admin/listaProdutos.php"><b>Backoffice</b></a></li>';
            }
			
		  }
		  ?>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
  
  <main id="main">

	<!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Detalhes da Viagem</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><a href="viagens.php">Viagens</a></li>
            <li>Detalhes da Viagem</li>
          </ol>
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->
	
	<!-- ======= Portfolio Details Section ======= -->
    <section class="portfolio-details">
      <div class="container">
	  <?php
			echo'

        <div class="portfolio-details-container">

          <img src="admin/'.e($p['imagem']).'" class="img-fluid" alt="'.e($p['produtoNome']).'">

          <div class="portfolio-info">
            <h3>'.e($p['produtoNome']).'</h3>
            <ul>
              <li><strong>Preço</strong>: '.e($p['preco']).' €</li>
              <li><strong>Viagens restantes</strong>: '.e($p['stock']).'</li>
              <li>';
			  
			  if (isset($_SESSION['idutilizador'])){
				  
                         echo '<br><a href="confirmacaoCompra.php?acao=add&id='.(int)$p['produtoID'].'"><center><button type="button" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Comprar</button></center></a>';
				}else{
                         echo '<br><center><small>Inicie sessão para comprar</small></center>';
				}
						  
			echo'
			  
			  </li>
            </ul>
          </div>

        </div>

        <div class="portfolio-description">
          <h2>Descrição</h2>
          <p>'.e($p['descricao']).'</p>
        </div>
		';
		?>
      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info" data-aos="fade-up" data-aos-delay="50">
              <h3>Voar Mais Alto</h3>
              <p class="pb-3"><em>Aqui estão algumas informações para nos poder contactar caso tenha alguma dúvida.</em></p>
              <p>
                Rua Exemplo 1 <br>
                2640-000 Mafra<br><br>
                <strong>Telefone:</strong> +351 210 000 000<br>
                <strong>Email:</strong> geral@voarmaisalto.pt<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="150">
            <h4>Links úteis</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="viagens.php">Viagens</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="servicos.php">Serviços</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="sobrenos.php">Sobre nós</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Política de privacidade</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter" data-aos="fade-up" data-aos-delay="350">
            <h4>Assine a nossa Newsletter</h4>
            <p>Fique por dentro de todas as nossas novidades, ofertas e descontos.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscrever">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Agência de viagens Voar Mais Alto</span></strong>. Todos os direitos reservados
      </div>
    </div>
  </footer><!-- End Footer -->


  <!-- Modal -->
<div class="modal fade" id="modallogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Login</h4>        
      </div>
      <div class="modal-body">
        <form class="modal-content animate" action="post_login.php" method="post">
			<div class="container">
			  <div class="form-group">
			  <br>
			  <label for="post_email"><b>Email:</b></label>
			  <input type="email" class="form-control" id="post_email" name="post_email" placeholder="Insira o email" required>
              <br></div>			  
			  <div class="form-group">
			  <label for="post_password"><b>Password:</b></label>
			  <input type="password" class="form-control" id="post_password" name="post_password" placeholder="Insira a Password" required>
			  </div>
			  
			  &emsp;
			  
			  <div class="form-group text-right">
			  <button type="submit" class="btn btn-primary">Login</button>
			  </div>
			</div>
		 </form>
      </div>
      <div class="modal-footer">
		<span class="psw">Não está registado?&emsp;<a href="register.php">Registe-se!</a></span>
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
	  </div>
    </div>
  </div>
</div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


</body>


</html>
