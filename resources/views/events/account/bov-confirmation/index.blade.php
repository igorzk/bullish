<x-table-withcreate title="notas" header="Lista de Notas de Corretagem" tableId="confTable" columnDefs="{
                    orderable: false,
                    searchable: false,
                    targets: 'viewEvent'}">
    <x-has-livewire/>
    <x-slot:create>
        @can('create-event')
            <a class="btn btn-secondary py-3 px-5" href="{{ route('bov-confirmations.create') }}">
                <span class="h6">Nova Nota</span>
            </a>
        @endcan
    </x-slot:create>
    <x-portfolio-filter route="bov-confirmations.index" :portfolios="$portfolios"/>
    <x-datatable tableId="confTable">
        <x-slot:thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">data da operação</th>
                <th scope="col">liquidação</th>
                <th scope="col">carteira</th>
                <th scope="col">conta</th>
                <th scope="col">valor</th>
                @can('view-files')
                <th>documento</th>
                @endcan
                <th>detalhes</th>
                <th scope="col" class="viewEvent">deletar</th>
            </tr>
        </x-slot:thead>
        @foreach ($confirmations as $confirmation)
            @php
                $value = number_format($confirmation->body["net_value"], 2, ",", ".");
            @endphp
            <tr>
                <td>{{ $confirmation->id }}</td>
                <td>{{ \Carbon\Carbon::parse( $confirmation->transaction_date )->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse( $confirmation->settlement_date )->format('d/m/Y') }}</td>
                <td>{{ $confirmation->custodyAccount->portfolio->nickname }}</td>
                <td>{{ $confirmation->custodyAccount->nickname }}</td>
                <td>{{ $value }}</td>
                @can('view-files')<td>
                    @livewire('show-pdf', ['filePath' => $confirmation->body['file_path']], key($confirmation->body['file-path']))
                </td>
                @endcan
                <td>
                    <a class="text-black" type="button" data-bs-toggle="modal"
                       data-bs-target="#modalDetalhar{{ $confirmation->id }}">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                <x-events.bovconfirmation-details :confirmation="$confirmation"/>
                </td>
                <td>
                    @if(!$confirmation->accountedFor())
                        <a class="text-danger" type="button" data-bs-toggle="modal"
                           data-bs-target="#modalDeletar{{ $confirmation->id }}">
                            <i class="fa-solid fa-ban"></i>
                        </a>
                        <x-modals.confirmation-danger modalId="modalDeletar{{ $confirmation->id }}"
                                                      modalTitle="Deletar nota de corretagem?"
                                                      modalText="Tem certeza que deseja deletar a nota de valor
                            {{ $value }} da carteira {{ $confirmation->custodyAccount->portfolio->nickname }}?"
                                                      modalMethod="DELETE"
                                                      modalAction="{{ route('bov-confirmations.destroy', $confirmation->id) }}"/>
                    @else
                        <span class="text-muted opacity-50"><i class="fa-solid fa-ban"></i></span>
                    @endif
                </td>
            </tr>
        @endforeach
        <x-slot:pagination>
            <div class="mt-2">
                {{ $confirmations->links() }}
            </div>
        </x-slot:pagination>
    </x-datatable>
</x-table-withcreate>
