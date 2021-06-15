<?php
      session_start();
      include '../db/config.php';
	  if (isset($_SESSION['utilizador']) && $_SESSION['tipo'] == "admin" ){	
        echo "Utilizador válido";
     }else{
		 header('location:../index.php');
	 }	 
       
       $id = $_GET['id'];
	   $nome = $_POST['produto'];
       $preco = $_POST['preco'];
       $descricao = $_POST['descricao'];
       $stock = $_POST['stock'];
       $cat = $_POST['categoria'];
       $imagem = $_FILES['imagem']['name'];

       if($imagem!=''){
           $pasta ="img_produtos/";
           if(move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta.$imagem)){
                $imagem =$pasta.$imagem ;
       }
       }

       $sql = "update produto set produtoNome='$nome',preco='$preco',stock='$stock',imagem='$imagem',categoriaID='$cat',descricao='$descricao' where produtoID='$id'";
       $resultado = $conexao->query($sql);

       if($resultado){
        $msg="Registo alterado";
       }else{
           $msg="Não foi possível alterar o registo";
       } 

     echo "<script> window.location = 'listaProdutos.php?msg=$msg';</script>";

       $conexao ->close();
?>