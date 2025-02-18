<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>
<?php include(HEADER_TEMPLATE); ?>

<?php $db = open_database(); ?>
<hr />

<div class="container">
    <h1 class="text-center my-4">Dashboard</h1>
    <hr />

    <?php if ($db) : ?>
        <div class="row text-center">
            <div class="col-xs-12 col-sm-6 col-md-4 mb-4">
                <div class="card border-primary shadow-sm">
                    <div class="card-body">
                        <i class="fa fa-plus fa-4x mb-3"></i>
                        <h5 class="card-title">Nova Atividade</h5>
                        <p class="card-text">Adicione uma nova atividade à BD.</p>
                        <a href="atividades/add.php" class="btn btn-primary btn-lg">Adicionar</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mb-4">
                <div class="card border-success shadow-sm">
                    <div class="card-body">
                        <i class="fa fa-file-text fa-4x mb-3"></i>
                        <h5 class="card-title">Atividades</h5>
                        <p class="card-text">Veja todas as atividades registadas.</p>
                        <a href="atividades/index.php" class="btn btn-success btn-lg">Visualizar</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mb-4">
                <div class="card border-danger shadow-sm">
                    <div class="card-body">
                        <i class="fa fa-exclamation-triangle fa-4x mb-3"></i>
                        <h5 class="card-title">Erros</h5>
                        <p class="card-text">Verifique erros ou problemas registados.</p>
                        <a href="erros/index.php" class="btn btn-danger btn-lg">Ver Erros</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">ERRO:</h4>
            <p>Não foi possível ligar ao Base de Dados!</p>
        </div>
    <?php endif; ?>
</div>

<?php include(FOOTER_TEMPLATE); ?>
