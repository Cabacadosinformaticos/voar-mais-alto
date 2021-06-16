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
	
</style>

</head>

<body>
<?php
  include 'db/config.php';
?>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html"><span>Voar Mais Alto</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li class="drop-down active"><a href="viagens.php">Viagens</a>
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

  <!-- Page Content -->
  <section id="hero">
    <div class="hero-container" data-aos="fade-up">
  <div class="container">
  
  <br></br>

    <div class="row">

      <div class="col-lg-1">

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-10">

        <div class="row">


  <?php 
  $id = $_GET['id'];
  $sql = "SELECT * FROM produto WHERE produtoID='$id'";
  $produtos = $conexao->query($sql);
  $p = $produtos->fetch_assoc();

  
  echo'<div class="container" style="margin-top:40px">
  <div class="card">
    <div class="row">
      <aside class="col-sm-5 border-right">
  <article class="gallery-wrap"> 
  <div class="img-big-wrap">
    <div> <a href="#"><img  style="height:550px  ; width: 338px; src="admin/'.$p['imagem'].'" ></a></div>
  </div> <!-- slider-product.// -->
  </article> 
      </aside>
      <aside class="col-sm-7">
  <article class="card-body p-5">
    <h3 class="title mb-3">'.$p['produtoNome'].'</h3>

  <p class="price-detail-wrap"> 
    <span class="price h3 text-warning"> 
      <span class="num">'.$p['preco'].'</span><span class="currency">€</span>
    </span> 
    <span>/por pessoa</span> 
  </p> <!-- price-detail-wrap .// -->
  <dl class="item-property">
  </dl>

  <hr>
    <div class="row">
      <div class="col-sm-5">
        <dl class="param param-inline">
          <dt>Quantity: </dt>
          <dd>
            <select class="form-control form-control-sm" style="width:70px;">';
            
            for ($x = 0; $x <= $p['stock']; $x++) {
              echo'<option> '.$x.' </option>';
            }
            

          echo '
          </select>
          </dd>
        </dl>  <!-- item-property .// -->
      </div> <!-- col.// -->
      
    </div> <!-- row.// -->
    <hr>
    <a href="finalizacao_compra.php" class="btn btn-lg btn-primary text-uppercase"> Buy now </a>
    <a href="#" class="btn btn-lg btn-outline-primary text-uppercase"> <i class="fas fa-shopping-cart"></i> Add to cart </a>
  </article> <!-- card-body.// -->
      </aside> <!-- col.// -->
    </div> <!-- row.// -->
  </div> <!-- card.// -->


  </div>';
  ?>



        </div>
        <!-- /.row -->

      </div>      
      <!-- /.col-lg-9 -->
     </div>
    <!-- /.row --> 
  </div>
  <br></br>
  <!-- /.container -->
  </div>
  </section>
  
  

  <!-- Footer -->
  <footer class="py-4 bg-dark">
  <br></br><br></br>
    <div>
      <p class="m-0 text-center text-white">Copyright &copy; Voar Mais Alto 2021</p>
    </div>
    <!-- /.container -->
  </footer>


  <div id="id01" class="modal">
  
  <form class="modal-content animate" action="validaLogin.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <br>
    <div class="container">
      <label for="uname"><b>Utilizador</b></label>
      <input type="text" placeholder="Insira o utilizador" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Insira a Password" name="psw" required>
        
      <button type="submit">Login</button>
 
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancelar</button>
      <span class="psw">Não está registado <a href="registar.php">Registe-se!</a></span>
    </div>
  </form>
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