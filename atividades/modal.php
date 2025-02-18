<!-- Modal de Delete-->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel">Eliminar Atividade</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Deseja realmente eliminar esta atividade?
            </div>
            <div class="modal-footer">
                <a id="confirm" class="btn btn-primary" href="#">Sim</a>
                <a id="cancel" class="btn btn-secondary" data-dismiss="modal">Não</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#delete-modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var atividadeId = button.data('atividade');
        var modal = $(this);
        modal.find('.modal-title').text('Eliminar atividade nº ' + atividadeId);
        modal.find('#confirm').attr('href', 'delete.php?id=' + atividadeId);
    });
</script>
