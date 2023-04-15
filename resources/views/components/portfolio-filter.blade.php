@props(['route', 'portfolios'])

<form class="ps-3 row" action="{{ route($route) }}" method="GET">
    <div class="col-sm-2 col-6">
        <label class="form-label" for="dtBegin">Data Inicial</label>
        <input class="form-control" type="date" id="dtBegin" name="dtBegin">
    </div>
    <div class="col-sm-2 col-6">
        <label class="form-label" for="dtEnd">Data Final</label>
        <input class="form-control" type="date" id="dtEnd" name="dtEnd">
    </div>
    <div class="col-sm-2 mt-sm-0 mt-2">
        <label class="form-label" for="portfolio_id">Carteira</label>
        <select class="form-select" type="date" id="portfolio_id" name="portfolio_id">
            <option value="">...</option>
            @foreach($portfolios as $portfolio)
                <option value="{{$portfolio['id']}}">{{ $portfolio['nickname'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-2 mt-sm-4 pt-2 mt-2 mb-sm-0 mb-4">
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>
</form>
