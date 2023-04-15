<x-app-layout title="{{ $title }}">
    <section class="container my-2">
        <div class="ms-3 mb-5">
            <article>
                <h4 class="mb-md-4 pb-3"> {{ $header }}</h4>
                <form action="{{ $route }}" method="POST"
                      @isset($enctype) enctype="{{ $enctype }}" @endisset>
                    @method($method)
                    @csrf
                    {{ $slot }}
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-5">{{ $create }}</button>
                    </div>
                </form>
            </article>
        </div>
    </section>
</x-app-layout>
