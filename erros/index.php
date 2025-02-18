<?php include('../inc/header.php'); ?>
<div class="container d-flex flex-column min-vh-100">
  <div class="content flex-grow-1">
    <h1 class="text-center my-4">Erros Registados</h1>
    <hr />
    <p>Aqui você pode visualizar todos os erros e problemas que ocorreram.</p>

    <?php
    // Caminho para o arquivo de log
    $log_file = 'erros.log';

    // Verifica se o arquivo de log existe
    if (file_exists($log_file)) {
      // Lê o conteúdo do arquivo
      $errors = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

      if (!empty($errors)) {
        echo '<ul class="list-group">';
        foreach ($errors as $error) {
          echo '<li class="list-group-item">' . htmlspecialchars($error) . '</li>';
        }
        echo '</ul>';
      } else {
        echo '<div class="alert alert-info" role="alert">Nenhum erro registado.</div>';
      }
    } else {
      echo '<div class="alert alert-danger" role="alert">Arquivo de log não encontrado.</div>';
    }
    ?>
  </div>
</div>
<?php include('../inc/footer.php'); ?>
