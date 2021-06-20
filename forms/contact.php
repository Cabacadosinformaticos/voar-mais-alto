<?php
  // Handler do formulário de contacto (classe "php-email-form" em sobrenos.php).
  // Devolve "OK" para o validate.js mostrar a mensagem de sucesso.

  $receiving_email_address = 'geral@voarmaisalto.pt';

  $name = isset($_POST['name']) ? trim($_POST['name']) : '';
  $email = isset($_POST['email']) ? trim($_POST['email']) : '';
  $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
  $message = isset($_POST['message']) ? trim($_POST['message']) : '';

  if ($name === '' || $email === '' || $subject === '' || $message === '') {
    echo 'Por favor preencha todos os campos.';
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Por favor insira um email válido.';
    exit;
  }

  $to = $receiving_email_address;
  $body = "Nome: $name\nEmail: $email\nAssunto: $subject\n\nMensagem:\n$message";
  $headers = "From: $email\r\nReply-To: $email\r\n";

  if (mail($to, $subject, $body, $headers)) {
    echo 'OK';
  } else {
    echo 'Não foi possível enviar a mensagem. Tente novamente mais tarde.';
  }
?>
