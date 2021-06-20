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
  session_start();
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
          <li class="nav-item">
            <a class="nav-link" href="listaProdutosVendidos.php">Vendas</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="../index.php"><b>Consultar o site</b></a>
         </li>       
		   <?php		  
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
  
  <br> </br>

  <!-- Page Content -->
  <div class="container">

    <div class="row">
	
	<div class="col-lg-4">
        
      </div>
	
      <!-- /.col-lg-3 -->

      <div class="col-lg-5">
	  
	  <br></br>

       <div class="row">
         <p> </p>           
       </div>
        <div class="row">

        <?php 
            $id = $_GET['id'];
            $sql1 = "Select * from categoria where CategoriaID = '$id'";
            $categoria =$conexao->query($sql1);
            if ($categoria->num_rows >0) {
              $p = $categoria->fetch_assoc();
            }
        ?>      

            <form action="alteraCategoria.php?id=<?=$id;?>" method="post" enctype="multipart/form-data">
              
			   <div class="form-group">
                    <label> Nome da categoria: </label>
                    <input type="text" name="categoria" class="form-control" value="<?=$p['CategoriaNome'];?>" required>
                </div>
                
                <input type="submit" value="Alterar" class="btn btn-primary">
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
  
  <br></br><br></br><br></br><br></br><br></br>
  <br></br><br></br><br></br><br></br><br></br>

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
