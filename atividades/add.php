<?php
require_once('functions.php');
add();
?>
<?php include(HEADER_TEMPLATE); ?>
<hr />
<h2 class="text-center">Nova Atividade</h2>
<hr />
<form action="add.php" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5>Informações da Atividade</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-7">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="atividades[nome]" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="descricao">Descrição</label>
                                <input type="text" class="form-control" name="atividades[descricao]" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="modalidade">Modalidade</label>
                                <input type="text" class="form-control" name="atividades[modalidade]" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="dinamizadores">Dinamizadores</label>
                                <input type="text" class="form-control" name="atividades[dinamizadores]" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5>Data e Local</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="data">Data</label>
                                <input type="date" class="form-control" name="atividades[data]" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="local">Local</label>
                                <input type="text" class="form-control" name="atividades[local]" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="destinatarios">Destinatários</label>
                                <input type="text" class="form-control" name="atividades[destinatarios]" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="numero_participantes">Nº Participantes</label>
                                <input type="number" min="0" class="form-control" name="atividades[numero_participantes]" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="custo">Custo (€)</label>
                                <input type="number" min="0" step="0.01" class="form-control" name="atividades[custo]" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="actions" class="row justify-content-center" style="margin-top: 20px; margin-bottom: 40px;">
            <div class="col-md-6 text-center">
                <button type="submit" class="btn btn-primary btn-lg mx-2">
                    <i class="fa fa-save"></i> Gravar
                </button>
                <a href="index.php" class="btn btn-secondary btn-lg mx-2">
                    <i class="fa fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </div>
    </div>
</form>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php include(FOOTER_TEMPLATE); ?>
