<x-create-form route="{{ route('bov-confirmations.store') }}" method="POST" create="Inserir" title="Inserir Nota"
               header="Inserir Nota de Corretagem:" enctype="multipart/form-data">
    <div x-data="{
         newTransaction: { purchase_sale: 'purchase', type: 'normal'},
         transactions: [],
         nextId: 1,
         newTransactionError: false,
         get transactionsTotalValue() { return sumTransactionValues(this.transactions) },
         get fees() { return (Number(this.values.net) * (this.credit_debit == 'credit' ? 1 : -1)) - Number(this.transactionsTotalValue) + Number(this.values.withholding_tax) },
         values: { net: '', withholding_tax: '' },
         credit_debit: 'credit',
         }"
         @new-asset-updated.window="newTransaction.newAsset = $event.detail">
        <x-has-livewire/>
        <div class="row">
            <div class="col-sm-8">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label class="form-label" for="transaction_date">Data da operação</label>
                        <input class="form-control" type="date" name="transaction_date" id="transaction_date"
                               value="{{ old('transaction_date') }}" required>
                        <p class="form-text">Data do pregão</p>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="settlement_date">Data de liquidação</label>
                        <input class="form-control" type="date" name="settlement_date" id="settlement_date"
                               value="{{ old('settlement_date') }}" required>
                        <p class="form-text">Data de liquidação da nota</p>
                    </div>
                </div>
                @livewire('select-account', $props)
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <label class="form-label" for="net_value">Valor líquido</label>
                        <input class="form-control" type="number" step="0.01" min="0" name="net_value" id="net_value"
                               x-model="values.net" required>
                        <p class="form-text">Valor líquido do débito ou crédito</p>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label" for="net_value">C/D</label>
                        <select class="form-select" name="credit_debit" x-model="credit_debit">
                            <option value="credit">
                               C
                            </option>
                            <option value="debit">
                                D
                            </option>
                        </select>
                        <p class="form-text">Créd/Deb</p>
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label" for="withholding_tax">IR Retido</label>
                        <input class="form-control" type="number"
                               step="0.01" min="0" name="withholding_tax" id="withholding_tax"
                               x-model="values.withholding_tax" required>
                        <p class="form-text">Imposto Retido na Fonte</p>
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label" for="fees">Corretagem/Taxas</label>
                        <input class="form-control" type="number" name="fees" id="fees"
                               :value="fees" required readonly>
                        <p class="form-text">Custos adicionais</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                @livewire('file-upload', ['inputName' => 'confirmation_file', 'required' => true])
            </div>
        </div>
        <div>
            <section class="mt-5 mb-2 ps-4 py-4 border border-3">
                <fieldset class="row">
                    <div class="col-sm-3">
                        @livewire('search-asset', ['type' => 'bov_stock'])
                    </div>
                    <div class="col-sm-1 col-4">
                        <label class="form-label" for="new_purchase_sale">C/V</label>
                        <select x-model="newTransaction.purchase_sale" class="form-select">
                            <option value="purchase">C</option>
                            <option value="sale">V</option>
                        </select>
                    </div>
                    <div class="col-sm-2 col-8">
                        <label class="form-label" for="new_type">Tipo</label>
                        <select x-model="newTransaction.type" class="form-select">
                            <option value="normal">Normal</option>
                            <option value="day-trade">Day-Trade</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label" for="new_price">Preço</label>
                        <input x-model="newTransaction.price" class="form-control" type="number" step="0.01" min="0.01">
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label" for="new_quantity">Quantidade</label>
                        <input x-model="newTransaction.quantity" class="form-control" type="number" min="1" step="1">
                    </div>
                    <div class="col-2 pt-4">
                        <button x-on:click="[newTransaction, nextId, newTransactionError] = addTransaction($data)"
                                class="p-2 btn btn-secondary" type="button">Nova Transação</button>
                    </div>
                </fieldset>
                <div x-show="newTransactionError" x-cloak class="pb-2 rounded rounded-1 pt-3 px-3 alert-danger mt-3 me-4" role="alert">
                    <div class="d-flex justify-content-between">
                        <p><strong>Erro ao inserir:</strong> cheque os valores nos campos obrigatórios acima.</p>
                        <button type="button" class="btn-close" x-on:click="newTransactionError = false" aria-label="Close"></button>
                    </div>
                </div>
            </section>
            <section class="container pb-5">
                <div class="w-100 overflow-scroll">
                    <table class="table table-striped table-light table-hover caption-top">
                        <caption>Lista de operações:</caption>
                        <thead>
                            <tr>
                                <th scope="col">Ativo</th>
                                <th scope="col">C/V</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <template x-for="transaction in transactions" :key="transaction.id">
                            <tr scope="row">
                                <td>
                                    <input class="form-control" hidden
                                           :name="`transactions[${transaction.id}][asset_id]`"
                                           :value="transaction.asset.id"
                                    >
                                    <input class="form-control" hidden
                                           :value="transaction.asset.name"
                                    >
                                    <span x-text="transaction.asset.name"></span>
                                </td>
                                <td>
                                    <input class="form-control" hidden
                                           :name="`transactions[${transaction.id}][purchase_sale]`"
                                           :value="transaction.purchase_sale"
                                    >
                                    <span x-text="transaction.purchase_sale == 'purchase' ? 'C' : 'V'"></span>
                                </td>
                                <td>
                                    <input class="form-control" hidden
                                           :name="`transactions[${transaction.id}][type]`"
                                           :value="transaction.type"
                                    >
                                    <span x-text="transaction.type"></span>
                                </td>
                                <td>
                                    <input class="form-control" hidden
                                           :name="`transactions[${transaction.id}][price]`"
                                           :value="transaction.price"
                                    >
                                    <span x-text="transaction.price"></span>
                                </td>
                                <td>
                                    <input class="form-control" hidden
                                           :name="`transactions[${transaction.id}][quantity]`"
                                           :value="transaction.quantity"
                                    >
                                    <span x-text="transaction.quantity"></span>
                                </td>
                                <td>
                                    <a type="button" x-on:click="transactions = deleteTransaction(transactions, transaction.id)" class="text-danger"><i class="fa-solid fa-ban"></i></a>
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <script>
        function validateTransaction(transaction) {
            let validated = false;
            validated =
                ['purchase', 'sale'].includes(transaction.purchase_sale) &&
                ['normal', 'day-trade'].includes(transaction.type) &&
                Number.isInteger(transaction.asset?.id) &&
                transaction.asset?.name != null &&
                !isNaN(transaction.price) &&
                !isNaN(transaction.quantity);
            if (validated) {
                validated =
                    Number(transaction.price) > 0 &&
                    Number(transaction.quantity) > 0
            }
            return validated;
        }
        function addTransaction({ newTransaction, transactions, nextId }) {
            let error = true;
            let insertedTransaction = {
                id: nextId,
                asset: newTransaction.newAsset,
                type: newTransaction.type,
                purchase_sale: newTransaction.purchase_sale,
                quantity: newTransaction.quantity,
                price: newTransaction.price,
            }
            if (validateTransaction(insertedTransaction)) {
                transactions.push(insertedTransaction);
                nextId++;
                newTransaction = {purchase_sale: 'purchase', type: 'normal'};
                window.livewire.emit('clearAsset');
                error = false;
            }
            return [ newTransaction, nextId, error ];
        }
        function deleteTransaction(transactions, id) {
            return transactions.filter(transaction => transaction.id !== id);
        }

        function sumTransactionValues(transactions) {
            let total = transactions.map(transaction =>
                transaction.price * transaction.quantity * (transaction.purchase_sale === 'purchase' ? -1 : 1)
            ).reduce((sum, val) => sum + val, 0);
            return total;
        }
    </script>
</x-create-form>
