<x-app-layout title="{{ $title }}">
    <section class="container my-2">
        <div class="ms-3 mb-5 d-sm-flex justify-content-between">
            <h4>{{ $header }}</h4>
            @isset($create)
            {{ $create }}
            @endisset
        </div>
        {{ $slot }}
    </section>
    <x-slot:scripts>
        <script src="{{ mix('js/datatables.js') }}"></script>
        <script>
            $(document).ready(() => $('#{{ $tableId }}').DataTable({
                paging: false,
                bInfo: false,
                columnDefs: [{!! $columnDefs !!}],
                language: ptBR,
                initComplete: () => $('#{{ $tableId }}_filter').addClass("mb-2")
            }));
        </script>
    </x-slot:scripts>
</x-app-layout>
