<x-cardlist-withcreate title="Contas de Custódia">
    <x-slot:header>
        <h4>Lista de Contas de Custódia:</h4>
    </x-slot:header>
    <x-slot:create>
        @can('create-account')
            <a class="btn btn-secondary py-3 px-5" href="{{ route('custody.create') }}">
                <span class="h6">Nova Conta</span>
            </a>
        @endcan
    </x-slot:create>
    @foreach ($accounts as $account)
        <x-card>
            <x-slot:header>
                <h4 class="card-title mt-2">{{ $account->nickname }}</h4>
                <p class="card-subtitle text-muted">
                    {{ $account->custodian->nickname . ' - ' . $account->account_identifier }}
                </p>
            </x-slot:header>
            <x-slot:body>
                <div class="list-group list-group-flush">
                    @can('view-investors')
                    <div class="d-flex justify-content-center list-group-item">
                        <p class="card-text me-2">investidor:</p>
                        <p class="card-text">{{ $account->investor->nickname }}</p>
                    </div>
                    @endcan
                    <div class="d-flex justify-content-center list-group-item">
                        <p class="card-text me-2">carteira:</p>
                        <p class="card-text">{{ $account->portfolio->nickname }}</p>
                    </div>
                    <div class="d-flex justify-content-center list-group-item">
                        <p class="card-text me-2">registrado em:</p>
                        <p class="card-text">
                            {{ \Carbon\Carbon::parse($account->created_at)->format('d/m/y') }}
                        </p>
                    </div>
                </div>
            </x-slot:body>
            <x-slot:buttonEdit>
                <form action="{{ route('custody.edit', $account) }}" method="GET">
                    @csrf
                    <button class="btn btn-secondary w-50" type="submit">
                        Editar
                    </button>
                </form>
            </x-slot:buttonEdit>
            <x-slot:buttonDelete>
                @if ($account->accountEvents->count() == 0)
                    <button class="btn btn-danger w-50" type="button" data-bs-toggle="modal"
                        data-bs-target="#modalDeletar{{ $account->id }}">
                        Deletar Conta
                    </button>
                    <x-modals.confirmation-danger modalId="modalDeletar{{ $account->id }}"
                        modalTitle="Deletar a conta {{ $account->nickname }}?"
                        modalText="Tem certeza que deseja deletar a
                            conta {{ $account->nickname }}?"
                        modalMethod="DELETE" modalAction="{{ route('custody.destroy', $account) }}" />
                @else
                    <div class="text-muted">
                        <p>Impossível excluir, possui movimentação</p>
                    </div>
                @endif
            </x-slot:buttonDelete>
        </x-card>
    @endforeach
</x-cardlist-withcreate>
