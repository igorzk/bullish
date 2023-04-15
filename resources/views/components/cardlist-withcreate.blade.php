<x-app-layout title="{{ $title }}">
    <section class="container my-2">
        <div class="ms-3 mb-5 d-sm-flex d-block justify-content-between">
            {{ $header }}
            {{ $create }}
        </div>
        <div class="row row-cols-md-3 row-cols-1 g-2 justify-content-center">
            {{ $slot }}
        </div>
    </section>
</x-app-layout>
