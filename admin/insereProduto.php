<?php
      session_start();
      include '../db/config.php';
		  
	 if (isset($_SESSION['utilizador']) && $_SESSION['tipo'] == "admin" ){	
        echo "Utilizador válido";
     }else{
		 header('location:../index.php');
	 }	 
		 
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

       $sql = "Insert into produto (produtoNome,preco,stock,imagem,categoriaID,descricao) values ('$nome','$preco', '$stock','$imagem','$cat', '$descricao')";
       $resultado = $conexao->query($sql);

       if($resultado){
        $msg="Registo inserido";
       }else{
           $msg="Erro ao inserir registo";
       } 

       echo "<script> window.location='listaProdutos.php?msg=$msg'; </script>";

       $conexao ->close();
?>