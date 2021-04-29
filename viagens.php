<!DOCTYPE html>
<html lang="en">

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
  <link href="css/shop-item.css" rel="stylesheet">
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

<body style="background-color:#ccddff">
<?php
  include 'db/config.php';
  session_start();
?>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand"><h3><n>Voar Mais Alto</n></h3></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="viagens.php">Viagens</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="servicos.php">Serviços</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sobrenos.php">Sobre nós</a>
          </li>
		  
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
        </ul>
      </div>
    </div>
  </nav>
  
  <br></br>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-2">
        <h2 class="my-4"><center>Paises</center></h2>
        <div class="list-group">
          
		  <?php
                $sql = "Select * from categoria";
                $cats =$conexao->query($sql);
                if ($cats->num_rows >0) {
                  while ($c = $cats->fetch_assoc()){
                    $cat=$c['CategoriaID'];
                  echo' <a href="viagens.php?id='.$c['CategoriaID'].'" class="list-group-item"><center>'.$c['CategoriaNome'].'</center></a>';
                  }
                }
            ?>
		  
		  </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-10">
	  
	  <br></br><br></br>

       <?php
         
       if(isset( $_GET['msg'])){
        $msg= $_GET['msg'];
        echo "<div class='alert alert-warning mx-auto'>" . $msg."</div>" ;
        unset($_GET['msg']); } 
		
		function limitarTexto($texto, $limite){
		$texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
		return $texto;
		}
		?>


        

        <div class="row">
          <?php 
		  			
			if (isset($_GET['id'])){	
			  $id = $_GET['id'];			
			  $sql = "Select * from produto where categoriaID='$id' order by produtoID desc limit 50 ";
		    }else{
			  $sql = "Select * from produto order by produtoID desc limit 50";
		    }          
            $produtos =$conexao->query($sql);
            if ($produtos->num_rows >0) {
              while ($p = $produtos->fetch_assoc()){

				$descricao = $p['descricao'];
				
                echo' <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                    <div class="containerI">
                    <img src="admin/'.$p['imagem'].'" alt="Avatar" class="card-img-top" style="height: 175px; width: 100%; display: block;">
                    </div>                  
                      <div class="card-body">
                        <h4 class="card-title">
                          <a><center>'.$p['produtoNome'].'</center></a>
						  
                        </h4>
                        <p class="card-text">'."<h6>Descrição: </h6>".''.(limitarTexto($descricao, $limite = 180)).'</p>
                        <h5>'."Preço: ".''.$p['preco'].' €</h5>
						&ensp;
                    <center><div class="overlayC"><a href="detalheProduto.php?id='.$p['produtoID'].'"><button type="button" class="btn btn-primary">Ver detalhes</button></a></div></center>
                      </div>';					  
					    if (isset($_SESSION['idutilizador'])){
                         echo '<div class="card-footer">
                               <center><a href="confirmacaoCompra.php?acao=add&id='.$p['produtoID'].'"><button type="button" class="btn btn-primary">&emsp;<i class="fas fa-cart-plus"></i>&emsp;</button></a></center>
                               </div>';
					      }
                    echo '</div>
                  </div> ';
              }
            }
            $conexao->close();
          ?>
  </div>
  <!-- /.container -->
  
	</div>
	</div>
	</div>
	
	<br></br>

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
  
  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>