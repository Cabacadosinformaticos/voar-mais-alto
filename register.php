<!doctype html>
<html lang="en">
  
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Agencia de viagens">
  <meta name="author" content="Tiago Cabaça">

  <title>Agencia de viagens - Voar Mais Alto</title>
  
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

  <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom styles for this template -->
  <link href="signin.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  
  
  <body>
  
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html"><span>Voar Mais Alto</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li class="drop-down"><a href="viagens.php">Viagens</a>
            <ul>
			<li>
			<a
                <?php
                $sql = "Select * from categoria";
                $cats =$conexao->query($sql);
                if ($cats->num_rows >0) {
                  while ($c = $cats->fetch_assoc()){
                    $cat=$c['CategoriaID'];
                  echo' <a href="viagens.php?id='.$c['CategoriaID'].'"><center>'.$c['CategoriaNome'].'</center></a>';
                  }
                }
				?>
            </a>
			</li>
			</ul>
          </li>
          <li><a href="servicos.php">Serviços</a></li>
          <li><a href="sobrenos.php">Sobre Nós</a></li>
          <li><a href="#footer">Contactos</a></li>
		  
		  <?php		  
		  //echo $_SESSION['utilizador'];
		  if (isset($_SESSION['utilizador'])){		  
			  echo '<li class="nav-item">';
			  echo '<a class="nav-link" href="post_logout.php"><i class="fa fa-user-alt"></i>  Sair</a>';
			  echo '</li>';		  
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
                echo '<li class="nav-item"><a class="nav-link" href="admin/listaprodutos.php"><b>Backoffice</b></a></li>';
            }
			
		  }
		  ?>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
  
  <main id="main">
  
  <br></br>
  
<main role="main" class="container">

		<!-- Ínicio dos elementos do Registo -->
	  <div class="container"> 
	    <h1><center>Registo</center></h1>
		<form action="post_register.php" method="post">
		  
		  <div class="form-group">
			<label for="exampleFormControlInput1">Nome de Utilizador</label>
			<input type="text" class="form-control" id="post_user" name="post_user" placeholder="ex: Tiago Cabaça" required>
		  </div>
		  
		  <div class="form-group">
			<label for="exampleFormControlInput1">Email</label>
			<input type="email" class="form-control" id="post_email" name="post_email" placeholder="ex: utilizador100@example.com" required>
		  </div>
		  
		  
		  <div class="form-group">
			<label for="exampleFormControlSelect1">Morada</label>
			<textarea class="form-control" id="post_morada" name="post_morada" rows="2" required></textarea>
		  </div>
		  <div class="form-group">
			<label for="exampleFormControlSelect2">Telefone</label>
			<input type="number" class="form-control" id="post_telefone" name="post_telefone" placeholder="Introduza número de telefone" required>
		  </div>
		  
		  <div class="form-group">
			<label for="exampleFormControlTextarea1">Insira a Password</label>
			<input type="password" class="form-control" id="post_password1" name="post_password1" placeholder="Escolha uma password forte" required>
		  </div>
		  <div class="form-group">
			<label for="exampleFormControlTextarea1">Reintroduza a Password</label>
			<input type="password" class="form-control" id="post_password2" name="post_password2" placeholder="Escolha uma password forte" required>
		  </div>
		   <button class="btn btn-lg btn-primary btn-block" type="submit">Registar-se</button>
		</form>

     </div><!-- Fim dos elementos do Registo -->
 </main>
 
	<br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br><br>
 
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
                Rua Exemplo, 1 <br>
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

          <div class="col-lg-2 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="150">
            <h4>Links úteis</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="viagens.php">Viagens</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="servicos.php">Serviços</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="sobrenos.php">Sobre nós</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Política de privacidade</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="250">
            
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter" data-aos="fade-up" data-aos-delay="350">
            <h4>Assine a nossa Newsletter</h4>
            <p>Fique por dentro de todas as nossas novidades, ofertas e descontos.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
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
			  <label for="uname"><b>Email:</b></label>
			  <input type="text" class="form-control" name="post_email" placeholder="Insira o utilizador" name="uname" required>
              <br></div>			  
			  <div class="form-group">
			  <label for="psw"><b>Password:</b></label>
			  <input type="password" class="form-control" name="post_password" placeholder="Insira a Password" name="psw" required>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
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
