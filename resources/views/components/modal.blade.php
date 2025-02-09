<div id="{{ $id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="{{ $id }}-content">
                    <!-- Aquí se insertará el contenido cargado dinámicamente -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function loadModalContent(modalId, ajaxFunction) {
    $.ajax({
        url: ajaxFunction, // URL proporcionada
        type: 'GET',
        success: function(response) {
            $('#' + modalId + '-content').html(response); // Carga la respuesta en el modal
        },
        error: function() {
            $('#' + modalId + '-content').html('<p class="text-danger">Error al cargar el contenido.</p>');
        }
    });
}
</script>
