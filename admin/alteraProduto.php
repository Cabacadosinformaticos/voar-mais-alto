<?php session_start(); if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') { header('Location: ../index.php'); exit; } ?>
<?php
      include '../db/config.php';

       csrf_check();

       $id = (int)$_GET['id'];
	   $nome = $_POST['produto'];
       $preco = $_POST['preco'];
       $descricao = $_POST['descricao'];
       $stock = $_POST['stock'];
       $cat = $_POST['categoria'];
       $imagem = '';

       if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK && $_FILES['imagem']['name'] != ''){
           $pasta ="img_produtos/";
           $permitidas = array('jpg', 'jpeg', 'png', 'webp');
           $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
           $info = @getimagesize($_FILES['imagem']['tmp_name']);
           if(in_array($ext, $permitidas, true) && $info !== false && $_FILES['imagem']['size'] <= 5 * 1024 * 1024){
                $novoNome = bin2hex(random_bytes(8)) . '.' . $ext;
                if(move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta.$novoNome)){
                     $imagem = $pasta.$novoNome;
                }
           }
       }

       if($imagem != ''){
           $stmt = mysqli_prepare($conexao, "update produto set produtoNome=?,preco=?,stock=?,imagem=?,categoriaID=?,descricao=? where produtoID=?");
           mysqli_stmt_bind_param($stmt, 'sdisisi', $nome, $preco, $stock, $imagem, $cat, $descricao, $id);
       }else{
           $stmt = mysqli_prepare($conexao, "update produto set produtoNome=?,preco=?,stock=?,categoriaID=?,descricao=? where produtoID=?");
           mysqli_stmt_bind_param($stmt, 'sdiisi', $nome, $preco, $stock, $cat, $descricao, $id);
       }
       $resultado = mysqli_stmt_execute($stmt);
       mysqli_stmt_close($stmt);

       if($resultado){
        $msg="Registo alterado";
       }else{
           $msg="Não foi possível alterar o registo";
       }

  header('Location: listaProdutos.php?msg='.urlencode($msg)); exit;

       $conexao ->close();
?>
