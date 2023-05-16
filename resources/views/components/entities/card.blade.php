@props(['entity', 'entityName', 'routeDestroy', 'routeUpdate'])

<x-card>
    <x-slot:header>
        <h4 class="card-title mt-2">{{ $entity->nickname }}</h4>
    </x-slot:header>
    <x-slot:body>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <p class="card-text me-2">Quantidades de contas cadastradas:</p>
                <p class="card-text">{{ $entity->custodyAccounts->count() }}</p>
            </div>
        </div>
        @php
            $entityId = $entity->id;
        @endphp
        <div class="row">
            <div class="col d-flex justify-content-center">
                <p class="card-text me-2">registrado em:</p>
                <p class="card-text">
                    {{ \Carbon\Carbon::parse($entity->created_at)->format('d/m/y') }}
                </p>
            </div>
        </div>
    </x-slot:body>
    <x-slot:buttonEdit>
        <button class="btn btn-secondary w-50" type="button" data-bs-toggle="modal"
            data-bs-target="#modalAlterar{{ $entityId }}">
            Renomear
        </button>
    </x-slot:buttonEdit>
    <x-slot:buttonDelete>
        @if ($entity->custodyAccounts->count() === 0)
            <button class="btn btn-danger w-50" type="button" data-bs-toggle="modal"
                data-bs-target="#modalDeletar{{ $entityId }}">
                Deletar
            </button>
        @else
            <div class="text-muted">
                <p>Impossível excluir, possui contas</p>
            </div>
        @endif
            <x-modals.confirmation-danger modalId="modalDeletar{{ $entityId }}"
                                          modalTitle="Deletar {{ $entityName }}?"
                                          modalText="Tem certeza que deseja deletar a
                            {{ $entityName }} {{ $entity->nickname }}?"
                                          modalMethod="DELETE" modalAction="{{ route($routeDestroy, $entity->id) }}" />
            <x-modals.form modalId="modalAlterar{{ $entityId }}" modalTitle="Alterando {{ $entityName }}?"
                           modalText="Alteração
                            {{ $entity->nickname }}" modalMethod="PATCH"
                           modalAction="{{ route($routeUpdate, $entity->id) }}">
                <div class="input-group">
                    <label class="input-group-text" for="nickname{{ $entityId }}">Novo Apelido</label>
                    <input class="form-control" id="nickname{{ $entityId }}" name="nickname">
                    <input type="hidden" name="id" value="{{ $entity->id }}">
                </div>
            </x-modals.form>
    </x-slot:buttonDelete>
</x-card>
