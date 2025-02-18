<?php
require_once('functions.php');

// Inicia a sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Busca a atividade específica
$atividade = view($_GET['id']);
?>

<?php include(HEADER_TEMPLATE); ?>
<br>
<h2 class="text-center">Atividade nº <?php echo htmlspecialchars($atividade['id']); ?></h2>
<hr>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>Nome e Detalhes</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nome:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($atividade['nome']); ?></dd>

                        <dt class="col-sm-4">Descrição:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($atividade['descricao']); ?></dd>

                        <dt class="col-sm-4">Modalidade:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($atividade['modalidade']); ?></dd>

                        <dt class="col-sm-4">Dinamizadores:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($atividade['dinamizadores']); ?></dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>Data e Local</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Data:</dt>
                        <dd class="col-sm-8"><?php echo date('d/m/Y', strtotime($atividade['data'])); ?></dd>

                        <dt class="col-sm-4">Local:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($atividade['local']); ?></dd>

                        <dt class="col-sm-4">Destinatários:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($atividade['destinatarios']); ?></dd>

                        <dt class="col-sm-4">Nº Participantes:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($atividade['numero_participantes']); ?></dd>

                        <dt class="col-sm-4">Custo:</dt>
                        <dd class="col-sm-8"><?php echo number_format($atividade['custo'], 2, ',', '.'); ?> €</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div id="actions" class="row justify-content-center" style="margin-top: 20px;">
        <div class="col-md-12 text-center">
            <a href="edit.php?id=<?php echo $atividade['id']; ?>" class="btn btn-warning btn-lg mx-2">
                <i class="fa fa-pencil"></i> Editar
            </a>
            <a href="index.php" class="btn btn-secondary btn-lg mx-2">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
            <a href="#" class="btn btn-danger btn-lg mx-2" data-toggle="modal" data-target="#delete-modal" data-atividade="<?php echo $atividade['id']; ?>">
                <i class="fa fa-trash"></i> Eliminar
            </a>
        </div>
    </div>
</div>

<?php include('modal.php'); ?>
<?php include(FOOTER_TEMPLATE); ?>
