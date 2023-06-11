<div class="dropdown">
    <label class="form-label" for="new_asset">Nome do ativo</label>
    <input wire:blur.debounce.200ms="clearAssets"
           wire:model.debounce.150ms="new_asset"
           wire:blur="markClear"
           wire:focus="preventClear"
           wire:input.debounce.150ms="changedSearch"
           class="form-control"
           id="new_asset" type="text">
    <div class="card position-absolute w-100">
        @if($showMenu)
        @foreach($assets as $asset)
            <button type="button"
                    class="dropdown-item"
                    wire:key="{{$asset['id']}}"
                    wire:blur.debounce.200ms="clearAssets"
                    wire:focus="preventClear"
                    wire:blur="markClear"
                    wire:click="assetSelected({{ $asset['id'] }})">{{ $asset['name'] }}
            </button>
        @endforeach
            <button
                wire:blur.debounce.200ms="clearAssets"
                wire:focus="preventClear"
                wire:blur="markClear"
                data-bs-toggle="modal" data-bs-target="#modalCreateAsset"
                type="button" class="btn btn-secondary">NOVO ATIVO</button>
        @endif
    </div>
    <div wire:ignore.self class="modal fade" id="modalCreateAsset" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Ativo</h5>
                    <button type="button" wire:click="clearInsertedAssetName" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <label class="input-group-text" for="assetName">Nome:</label>
                        <input class="form-control" id="assetName" type="text" wire:model="insertedAssetName">
                    </div>
                    <div class="d-flex justify-content-end">
                        <p class="form-text mt-2">Nome único de identificação do ativo</p>
                    </div>
                </div>
                @error('insertedAssetName') <span class="alert alert-danger">{{ $message }}</span> @enderror
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            wire:click="clearInsertedAssetName"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    @if(!$errors->any() and $insertedAssetName != '')
                    <button type="button" class="btn btn-primary"
                            wire:click="insertAsset"
                            data-bs-dismiss="modal">
                        Inserir
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

