<?php session_start(); include 'db/config.php'; ?>
<!doctype html>
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
          <li class="drop-down"><a href="viagens.php">Viagens</a>
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
		  //echo $_SESSION['utilizador'];
		  if (isset($_SESSION['utilizador'])){
			  echo '<li class="drop-down"><a><i class="fa fa-user-alt"></i> '.e($_SESSION['utilizador']).'</a>
					<ul>
					<li><a class="nav-link" href="post_logout.php" style="color:red;"><center>Sair</center></a></li>
					</ul>
					</li>';
		  }else{
			  echo '<li class="nav-item">';
			  echo '<a class="nav-link" href="#modallogin" data-toggle="modal" data-target="#modallogin"><i class="fa fa-user-alt"></i></a>';
			  echo '</li>';
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

    <div class="container" style="margin-top:110px; margin-bottom:60px;">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <h1 class="h3 mb-4 text-center">Registo</h1>

          <?php
          if (isset($_GET['msg']) && $_GET['msg'] !== '') {
            $msg = $_GET['msg'];
            $tipoMsg = (stripos($msg, 'sucesso') !== false) ? 'alert-success' : 'alert-danger';
            echo '<div class="alert ' . $tipoMsg . '" role="alert">' . e($msg) . '</div>';
          }
          ?>

          <form action="post_register.php" method="post">

            <div class="form-group">
              <label for="post_user">Nome de utilizador</label>
              <input type="text" class="form-control" id="post_user" name="post_user" placeholder="ex: Tiago Cabaça" required>
            </div>

            <div class="form-group">
              <label for="post_email">Email</label>
              <input type="email" class="form-control" id="post_email" name="post_email" placeholder="ex: nome@exemplo.pt" required>
            </div>

            <div class="form-group">
              <label for="post_morada">Morada</label>
              <textarea class="form-control" id="post_morada" name="post_morada" rows="2" placeholder="ex: Rua das Flores, nº 3" required></textarea>
            </div>

            <div class="form-group">
              <label for="post_telefone">Telefone</label>
              <input type="tel" class="form-control" id="post_telefone" name="post_telefone" placeholder="ex: 912 345 678" pattern="[0-9 +]{9,16}" required>
            </div>

            <div class="form-group">
              <label for="post_password1">Password</label>
              <input type="password" class="form-control" id="post_password1" name="post_password1" placeholder="Mínimo 6 caracteres" minlength="6" autocomplete="new-password" required>
            </div>

            <div class="form-group">
              <label for="post_password2">Repita a password</label>
              <input type="password" class="form-control" id="post_password2" name="post_password2" placeholder="Repita a password" minlength="6" autocomplete="new-password" required>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Registar</button>
          </form>
        </div>
      </div>
    </div>

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
        <form action="post_login.php" method="post">
          <div class="form-group">
            <label for="post_email">Email</label>
            <input type="email" class="form-control" id="post_email" name="post_email" placeholder="Insira o email" required>
          </div>
          <div class="form-group">
            <label for="post_password">Password</label>
            <input type="password" class="form-control" id="post_password" name="post_password" placeholder="Insira a password" required>
          </div>
          <div class="form-group text-right mb-0">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <span class="psw">Não está registado? <a href="register.php">Registe-se!</a></span>
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
    
  </body>
</html>
