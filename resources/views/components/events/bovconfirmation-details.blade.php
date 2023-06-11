@props(['confirmation'])
<div>
    <x-modals.generic-big modalId="modalDetalhar{{ $confirmation->id }}"
                          modalTitle="Detalhes da Nota">
        <div class="modal-body m-3">
            <div class="d-flex align-items-start">
                <div class="me-2 fw-bold">Carteira:</div><div>{{ $confirmation->custodyAccount->portfolio->nickname }}</div>
            </div>
            <div class="container text-center mt-3 border rounded rounded-3 p-3">
                <div class="row">
                    <div class="col d-flex">
                        <div class="me-2">corretora:</div><div>{{ $confirmation->custodyAccount->custodian->nickname }}</div>
                    </div>
                    <div class="col d-flex">
                        <div class="me-2">investidor:</div><div>{{ $confirmation->custodyAccount->investor->nickname }}</div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col d-flex">
                        <div class="me-2">data:</div><div>{{ \Carbon\Carbon::parse( $confirmation->transaction_date )->format('d/m/Y') }}</div>
                    </div>
                    <div class="col d-flex">
                        <div class="me-2">liquidação:</div><div>{{ \Carbon\Carbon::parse( $confirmation->settlement_date )->format('d/m/Y') }}</div>
                    </div>
                </div>
                <div class="row border border-top border-0 my-3 pt-2">
                    <div class="col d-flex">
                        <div class="me-2">líquido:</div><div>{{ number_format($confirmation->body['net_value'], 2, ",", ".") }}</div>
                    </div>
                    <div class="col d-flex">
                        <div class="me-2">taxas:</div><div>{{ number_format($confirmation->body['fees'], 2, ",", ".") }}</div>
                    </div>
                    <div class="col d-flex">
                        <div class="me-2">IR retido:</div><div>{{ number_format(-$confirmation->body['withholding_tax'], 2, ",", ".") }}</div>
                    </div>
                </div>
                <div class="mt-2 d-flex">
                    <div class="me-2">Total operacoes:</div>
                    <div>
                        {{ number_format(-array_reduce($confirmation->body['transactions'], fn($sum, $t) => $sum + $t['price'] * $t['quantity'] ), 2, ",", ".") }}
                    </div>
                </div>
            </div>
            <div class="overflow-scroll w-10 table-responsive p-2">
                <table id="operacoes" class="mt-3 table table-fixed">
                    <thead>
                    <tr>
                        <th class="fw-normal" scope="col">Ativo</th>
                        <th class="fw-normal" scope="col">Tipo</th>
                        <th class="fw-normal" scope="col">Quantidade</th>
                        <th class="fw-normal" scope="col">Preço</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $transactions = $confirmation->body['transactions'];
                    usort($transactions,
                        fn($t1, $t2) => (($t1['asset_id'] == $t2['asset_id']) ?
                            ($t1['type'] > $t2['type']) : ($t1['asset_id'] > $t2['asset_id']))
                        );
                    @endphp
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ App\Models\Market\Asset::find($transaction['asset_id'])->name }}</td>
                            <td>
                                {{ $transaction['type'] }}
                            </td>
                            <td>
                                {{ $transaction['quantity'] }}
                            </td>
                            <td>
                                {{ number_format($transaction['price'], 2, ",", ".") }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
        </div>
    </x-modals.generic-big>
</div>
