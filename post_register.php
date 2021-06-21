<?php

include('db/config.php');

$post_user = isset($_POST['post_user']) ? trim($_POST['post_user']) : '';
$post_email = isset($_POST['post_email']) ? trim($_POST['post_email']) : '';
$post_morada = isset($_POST['post_morada']) ? trim($_POST['post_morada']) : '';
$post_telefone = isset($_POST['post_telefone']) ? trim($_POST['post_telefone']) : '';
$post_password1 = isset($_POST['post_password1']) ? $_POST['post_password1'] : '';
$post_password2 = isset($_POST['post_password2']) ? $_POST['post_password2'] : '';

if ($post_password1 !== $post_password2) {
    header('Location: register.php?msg=' . urlencode('As passwords não coincidem.'));
    exit;
}

if (!filter_var($post_email, FILTER_VALIDATE_EMAIL)) {
    header('Location: register.php?msg=' . urlencode('Insira um email válido.'));
    exit;
}

if (strlen($post_password1) < 6) {
    header('Location: register.php?msg=' . urlencode('A password deve ter pelo menos 6 caracteres.'));
    exit;
}

// Verificar se o email já está registado.
$check = mysqli_prepare($conexao, "SELECT id FROM login WHERE email=?");
mysqli_stmt_bind_param($check, 's', $post_email);
mysqli_stmt_execute($check);
mysqli_stmt_store_result($check);
if (mysqli_stmt_num_rows($check) > 0) {
    mysqli_stmt_close($check);
    header('Location: register.php?msg=' . urlencode('Já existe um registo com este email.'));
    exit;
}
mysqli_stmt_close($check);

$post_password = password_hash($post_password1, PASSWORD_DEFAULT);
$tipo = 'user';

$stmt = mysqli_prepare($conexao, "Insert into login(utilizador,email,password,morada,telefone,tipo) values (?,?,?,?,?,?)");
mysqli_stmt_bind_param($stmt, 'ssssss', $post_user, $post_email, $post_password, $post_morada, $post_telefone, $tipo);
$resultado = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$conexao->close();

if ($resultado) {
    header('Location: index.php?msg=' . urlencode('Registo efetuado com sucesso'));
} else {
    header('Location: register.php?msg=' . urlencode('Erro ao efetuar o registo'));
}
exit;

?>
