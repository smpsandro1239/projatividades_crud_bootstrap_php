<!-- Modal de Delete-->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel">Eliminar Atividade</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Deseja realmente eliminar esta atividade?
            </div>
            <div class="modal-footer">
                <a id="confirm" class="btn btn-danger" href="#">Sim</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('delete-modal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const atividadeId = button.getAttribute('data-atividade');
                const modalTitle = this.querySelector('.modal-title');
                const confirmLink = this.querySelector('#confirm');

                modalTitle.textContent = 'Eliminar atividade nº ' + atividadeId;
                confirmLink.href = 'delete.php?id=' + atividadeId;
            });
        }
    });
</script>
