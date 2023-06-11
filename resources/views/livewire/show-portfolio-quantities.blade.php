<div class="container m-2">
    <div class="d-flex w-50 mt-5">
        <label for="portfolio-select">Selecione uma Carteira:</label>
        <select wire:model="selectedPortfolio" class="form-select" id="portfolio-select" name="selectedPortfolio">
            @if($selectedPortfolio == 'empty')
                <option value="empty">Selecionar...</option>
            @endempty
            @foreach($portfolios as $portfolio)
                <option wire:key="{{ $portfolio["id"] }}" value="{{ $portfolio["id"] }}">{{ $portfolio["nickname"] }}</option>
            @endforeach
        </select>
    </div>
    @if(sizeof($stockQuantities) > 0)
        <div class="container mt-5 pt-2">
            <div class="py-3">
                <h4>Carteira {{$portfolioName}}</h4>
            </div>
            <table class="table table-striped table-light table-hover">
                <thead>
                <tr>
                    <th scope="col">Ação</th>
                    <th scope="col">Quantidade</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stockQuantities as $name => $quantity)
                    <tr>
                        <td>{{ $name }}</td>
                        <td>{{ $quantity }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
