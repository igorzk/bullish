<x-modals.generic modalId="{{ $modalId }}" modalTitle="{{ $modalTitle }}">
    <form class="modal-body" action="{{ $modalAction }}" method="POST">
        @method($modalMethod)
        @csrf
        <div class="mb-4">Cadastro - {{ $modalText }}</div>
        {{ $slot }}
        <div class="modal-footer mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
    </form>
</x-modals.generic>
