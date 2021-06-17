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
          <li class="nav-item active">
            <a class="nav-link" href="listaProdutos.php">Produtos
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="listaCategorias.php">Categorias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="listaUtilizadores.php">Utilizadores</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="../index.php"><b>Consultar o site</b></a>
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
  <div class="container-fluid">

    <div class="row">
	  <div class="col-lg-1">
	  </div>
      <div class="col-lg-1">
        <h3 class="my-4"><center>Categorias</center></h3>
        <div class="list-group">

            <?php
                $sql = "Select * from categoria";
                $cats =$conexao->query($sql);
                if ($cats->num_rows >0) {
                  while ($c = $cats->fetch_assoc()){
                    $cat=$c['CategoriaID'];
                    echo '<a href="listaProdutos.php?id='.$c['CategoriaID'].'" class="list-group-item"><center>'.$c['CategoriaNome'].'</center></a>';
                  }
                }
            ?>
        </div>
      </div>
      <!-- /.col-lg-3 -->
      <div class="col-lg-9">
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
        <br></br>
        <div class="row">
           <a href="inserirProdutos.php"><button type="button" class="btn btn-primary">Inserir uma nova viagem</button></a>     
        </div>
		&emsp;
        <div class="row">
          <table class="table table-hover table-bordered">
            <thead class="bg-light">
            <tr>
                <td>Nome </td>
                <td>Preço </td>
                <td>Descrição </td>
                <td>Imagem </td>
                <td>Categoria </td>
                <td>Stock </td>
            </tr>
            </thead>
            <tbody>
          <?php 
		  if (isset($_GET['id'])){	
			  $id = $_GET['id'];
			  $sql = "Select * from produto, categoria where produto.categoriaID = categoria.categoriaID and produto.categoriaID='$id'";
		    }else{
			  $sql = "Select * from produto, categoria where produto.categoriaID = categoria.categoriaID";
		    }    
            
            $produtos =$conexao->query($sql);
            if ($produtos->num_rows >0) {
              while ($p = $produtos->fetch_assoc()){
                $img = $p['imagem'];     
                echo'
                <tr>
                    <td>'.$p['produtoNome'].'</td>
                    <td>'.$p['preco'].' </td>
                    <td>'.$p['descricao'].' </td>
                    <td><img src="'.$p['imagem'].'" style="width:200px; height:auto;"></td>
                    <td>'.$p['CategoriaNome'].' </td>
                    <td>'.$p['stock'].' </td>
                    
					<td><a href="alterarProduto.php?id='.$p['produtoID'].'"><center><button type="button" class="btn btn-primary">Editar</button></center></a></td>
                    <td><a onClick=\'javascript: return confirm ("Tem a certeza que deseja eliminar o registo?");\' href="eliminarProduto.php?id='.$p['produtoID'].'"><center><button type="button" class="btn btn-secondary">Eliminar</button></center></a></td>
                 
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
