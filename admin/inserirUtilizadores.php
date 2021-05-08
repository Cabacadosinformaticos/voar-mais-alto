<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Agencia de viagens">
  <meta name="author" content="Tiago Cabaça">

  <title>Agencia de viagens - Voar Mais Alto</title>
  
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
?>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand"><h3><n>Backoffice</n></h3></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="listaProdutos.php">Produtos
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="listaCategorias.php">Categorias</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="listaUtilizadores.php">Utilizadores</a>
          </li>
		  
           <?php
		  session_start();
		  if (isset($_SESSION['utilizador']) && $_SESSION['tipo'] == "admin" ){
			  echo '<li class="nav-item">';
			  echo '<a class="nav-link" href="post_logout.php"><i class="fa fa-user-alt"></i>  Sair</a>';
			  echo '</li>';		  
		  }else{
			  header('location:../index.php');
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
	
	<div class="col-lg-4">
        
      </div>
	  
      <!-- /.col-lg-3 -->

      <div class="col-lg-5" >
	  
	  <br></br>

       <div class="row">
         <p> </p>           
       </div>
        <div class="row">

            <form action="insereUtilizador.php" method="post" enctype="multipart/form-data">
                <div class="form-group" center>
                    <label> Nome do utilizador: </label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="form-group">
                    <label> Email: </label>
                    <input type="text" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label> Morada: </label>
                    <input type="text" name="morada" class="form-control" required>
                </div>
                <div class="form-group">
                    <label> Telefone: </label>
                    <input type="text" name="telefone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label> Palavra-passe: </label>
                    <input type="text" name="password" class="form-control" required>
                </div>
                <div class="form-group">
				<label for="tipo">Escolha o tipo de conta:</label>

				<select name="tipo">
					<option value="user">Utilizador nomal</option>
					<option value="admin">Administrador</option>
				</select>
				</div>

                <input type="submit" value="Inserir" class="btn btn-primary">
            </form>
         

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->



</div>
     </div>
    <!-- /.row --> 
  </div>
  <!-- /.container -->
  
  <br></br>

  <!-- Footer -->
  <footer class="py-5 bg-dark rodape">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Voar Mais Alto 2021</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>





</body>


</html>