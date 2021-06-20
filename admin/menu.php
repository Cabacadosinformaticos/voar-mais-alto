<?php
  // Menu do backoffice. Antes de incluir, definir $pagina_ativa com o nome do ficheiro da lista.
  if (!isset($pagina_ativa)) { $pagina_ativa = ''; }
  $itens_menu = array(
    'listaProdutos.php' => 'Viagens',
    'listaCategorias.php' => 'Destinos',
    'listaUtilizadores.php' => 'Utilizadores',
    'listaProdutosVendidos.php' => 'Vendas'
  );

  // Mostra a mensagem recebida em ?msg= (verde se correu bem, vermelho se falhou).
  function mostrar_mensagem() {
    if (!isset($_GET['msg']) || $_GET['msg'] === '') {
      return;
    }
    $msg = (string)$_GET['msg'];
    $ok = false;
    foreach (array('sucesso', 'inserido', 'alterado', 'eliminado') as $palavra) {
      if (stripos($msg, $palavra) !== false) {
        $ok = true;
      }
    }
    $classe = $ok ? 'alert-success' : 'alert-danger';
    echo '<div class="alert '.$classe.' alert-dismissible" role="alert">'.e($msg).'
      <button type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
    </div>';
  }

  // Converte datas guardadas como dd/mm/aaaa (ou aaaa-mm-dd) para dd/mm/aaaa. Vazio devolve "-".
  function formatar_data($data) {
    $data = trim((string)$data);
    if ($data === '') {
      return '-';
    }
    $t = strtotime(str_replace('/', '-', $data));
    if ($t === false) {
      return e($data);
    }
    return date('d/m/Y', $t);
  }
?>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="listaProdutos.php"><span>Backoffice</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Abrir menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <?php
            foreach ($itens_menu as $ficheiro => $nome) {
              $ativo = ($ficheiro === $pagina_ativa);
              echo '<li class="nav-item'.($ativo ? ' active' : '').'">';
              echo '<a class="nav-link" href="'.e($ficheiro).'">'.e($nome);
              if ($ativo) {
                echo ' <span class="sr-only">(atual)</span>';
              }
              echo '</a></li>';
            }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Consultar o site</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="post_logout.php"><i class="fa fa-user-alt"></i> Sair</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
