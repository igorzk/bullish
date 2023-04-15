@props(['status'])

@if ($status)
    <div {{ $attributes }}>
        <div class="d-flex justify-content-between">
            {{ $status }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
