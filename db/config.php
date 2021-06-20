<?php
    $servidor='localhost';
    $utilizador ='root';
    $password ='';
    $basededados ='bd_voarmaisalto';

    $conexao=mysqli_connect($servidor, $utilizador, $password, $basededados);

    if ($conexao ->connect_error) {
      die("Erro ao ligar à base de dados: " .$conexao->connect_error);
    }
    mysqli_set_charset($conexao,"utf8");

    // Escapa um valor para ser impresso em HTML (proteção contra XSS).
    function e($s) {
        return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
    }

    // Devolve o token CSRF da sessão, criando-o na primeira utilização.
    function csrf_token() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    // Valida o token CSRF enviado no POST; termina o pedido se for inválido.
    function csrf_check() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
        if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], (string)$token)) {
            http_response_code(403);
            die('Pedido inválido.');
        }
    }
?>
