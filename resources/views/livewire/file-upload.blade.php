<div class="ms-0">
    <div class="mb-1">
        <input wire:model="file" class="form-control" name="{{ $inputName }}"
               @if($required)required="required" @endif id="file" type="file" >
        <label for="file" class="ms-2 mt-2 text-muted form-label">
            selecione arquivo pdf
        </label>
    </div>
    @error('file')
    <div>
        <p>
           {{ $message }}
        </p>
    </div>
    @enderror
    @if($file)
        <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                data-bs-target="#showPdf">
            <span>Visualizar arquivo</span>
            <span class="mt-1 ms-2"><i class="fa-solid fa-magnifying-glass"></i></span>
        </button>
        <x-modals.fullscreen modalId="showPdf" modalTitle="Visualização:">
            <div class="mt-3 p-2 border border-1 border-secondary d-flex justify-content-center">
                <div>
                    <embed class="min-vh-100 min-vw-100"
                           src="data:application/pdf;base64,{{ base64_encode($file->get()) }}">
                </div>
            </div>
        </x-modals.fullscreen>
    @endif
</div>
