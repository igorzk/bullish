<section class="container">
    @isset($header)
    <div>
        <h4>{{ $header }}</h4>
    </div>
    @endisset
    <div class="w-100 overflow-scroll">
        <table id="{{ $tableId }}" class="table table-striped table-light table-hover">
            <thead>
                {{ $thead }}
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
            {{ $pagination ? $pagination : null}}
    </div>
</section>
