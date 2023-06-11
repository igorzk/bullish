<div>
<a type="button" class="text-black" data-bs-toggle="modal"
        data-bs-target="#showPdf" wire:click="showFile">
    <span class="mt-1 ms-2"><i class="fa-solid fa-download"></i></span>
</a>
<x-modals.fullscreen modalId="showPdf" modalTitle="Visualização:">
    <div class="mt-3 p-2 border border-1 border-secondary d-flex justify-content-center">
        <div>
            @if($file)
                <embed class="min-vh-100 min-vw-100"
                       src="data:application/pdf;base64,{{ $file }}">
            @endif
        </div>
    </div>
</x-modals.fullscreen>
</div>
