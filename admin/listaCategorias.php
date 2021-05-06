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
  <link rel="stylesheet" href="../css/shop-homepage.css">
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
          <li class="nav-item active">
            <a class="nav-link" href="listaCategorias.php">Categorias</a>
          </li>
          <li class="nav-item">
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
	
	<div class="col-lg-2">
        
      </div>
      
      <!-- /.col-lg-3 -->
      <div class="col-lg-8">
        <div class="row">
        <p> <br></p>
                <?php
                if (isset($_GET['msg'])) {
                  $msg = $_GET['msg'];
                  echo'<div class="alert alert-warning alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    '.$msg.'
                  </div>';
                  unset($_GET['msg']);
                }
                ?>
        </div>
        <br>
        <div class="row">
           <a href="inserirCategorias.php"><center><button type="button" class="btn btn-primary">Inserir um novo destino</button></center></a>     
        </div>
		&emsp;
        <div class="row">
          <table class="table table-hover table-bordered">
            <thead class="bg-light">
            <tr>
                <td><center>Categoria</center></td>              
            </tr>
            </thead>
            <tbody>
          <?php 
            $sql = "Select * from categoria order by categoriaID ASC";
            $categorias =$conexao->query($sql);
            if ($categorias->num_rows >0) {
              while ($p = $categorias->fetch_assoc()){               
                echo'
                <tr>
                    <td><center>'.$p['CategoriaNome'].'</center></td>              
                    
					<td><a href="alterarCategoria.php?id='.$p['CategoriaID'].'"><center><button type="button" class="btn btn-primary">Editar</button></center></a></td>
                    <td><a onClick=\'javascript: return confirm ("Tem a certeza que deseja eliminar o registo?");\' href="eliminarCategoria.php?id='.$p['CategoriaID'].'"><center><button type="button" class="btn btn-secondary">Eliminar</button></center></a></td>
                 
				 </tr>';
              }
            }
            $conexao->close();
          ?>
          </tbody>
          </table>
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
  <footer class="py-5 bg-dark">
    <div>
      <p class="m-0 text-center text-white">Copyright &copy; Voar Mais Alto 2021</p>
    </div>
    <!-- /.container -->
  </footer>




  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>


</html>
