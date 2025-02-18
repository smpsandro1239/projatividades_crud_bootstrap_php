<?php
require_once('functions.php');

// Inicia a sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Busca todas as atividades
$atividades = index();

// Limpa mensagens de sessão se existirem
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $type = $_SESSION['type'];
    clear_messages(); // Chama a função para limpar mensagens
}

include(HEADER_TEMPLATE);
?>

<header>
    <hr />
    <div class="row mb-4">
        <div class="col-sm-6">
            <h2>Atividades</h2>
        </div>
        <div class="col-sm-6 text-right">
            <div class="card shadow-sm mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <input type="text" class="form-control mr-2" id="search" placeholder="Pesquisar..." style="max-width: 250px;">
                    <div class="btn-group">
                        <a class="btn btn-primary" href="add.php"><i class="fa fa-plus fa-lg mr-2"></i> Adicionar Atividade</a>
                        <a class="btn btn-secondary" href="index.php"><i class="fa fa-refresh fa-lg"></i> Atualizar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<?php if (isset($message)): ?>
    <div class="alert alert-<?php echo $type; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Modalidade</th>
                <th>Dinamizadores</th>
                <th>Data</th>
                <th>Local</th>
                <th>Destinatários</th>
                <th>Nº Participantes</th>
                <th>Custo (€)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($atividades): ?>
                <?php foreach ($atividades as $atividade): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($atividade['id']); ?></td>
                        <td><?php echo htmlspecialchars($atividade['nome']); ?></td>
                        <td><?php echo htmlspecialchars($atividade['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($atividade['modalidade']); ?></td>
                        <td><?php echo htmlspecialchars($atividade['dinamizadores']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($atividade['data'])); ?></td>
                        <td><?php echo htmlspecialchars($atividade['local']); ?></td>
                        <td><?php echo htmlspecialchars($atividade['destinatarios']); ?></td>
                        <td><?php echo htmlspecialchars($atividade['numero_participantes']); ?></td>
                        <td><?php echo number_format($atividade['custo'], 2, ',', '.'); ?></td>
                        <td class="actions text-right">
                            <div class="btn-group" role="group">
                                <a href="view.php?id=<?php echo $atividade['id']; ?>" class="btn btn-success btn-sm mr-2">
                                    <i class="fa fa-eye"></i> Visualizar
                                </a>
                                <a href="edit.php?id=<?php echo $atividade['id']; ?>" class="btn btn-warning btn-sm mr-2">
                                    <i class="fa fa-pencil"></i> Editar
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal" data-atividade="<?php echo $atividade['id']; ?>">
                                    <i class="fa fa-trash"></i> Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11" class="text-center">Nenhum registo encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById("search").addEventListener("keyup", function() {
        var filter = this.value.toUpperCase();
        var rows = document.querySelectorAll("table tbody tr");

        rows.forEach(function(row) {
            var cells = row.getElementsByTagName("td");
            var match = false;
            for (var i = 0; i < cells.length; i++) {
                if (cells[i].textContent.toUpperCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
            row.style.display = match ? "" : "none";
        });
    });
</script>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>
