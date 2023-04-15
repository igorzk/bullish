@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="d-flex justify-content-between">
            <div>
                {{ __('Whoops! Something went wrong.') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <ul class="mt-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
