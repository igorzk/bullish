<x-modals.generic modalId="{{ $modalId }}" modalTitle="{{ $modalTitle }}">
    <div class="modal-body">
        <p>{{ $modalText }}</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form action="{{ $modalAction }}" method="POST">
            @method($modalMethod)
            @csrf
            <button type="submit" class="btn btn-danger">Confirmar</button>
        </form>
    </div>
</x-modals.generic>
