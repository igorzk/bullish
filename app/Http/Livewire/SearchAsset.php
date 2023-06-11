<?php

namespace App\Http\Livewire;

use App\Models\Market\Asset;
use Illuminate\Support\Str;
use Livewire\Component;

class SearchAsset extends Component
{

    public $new_asset;
    public $assets;
    public $selectedAsset;
    public $preventClearing;
    public $showMenu;
    public $type;
    public $insertedAssetName;

    protected $rules = [
        'insertedAssetName' => 'required|min:3|unique:assets,name',
    ];

    protected $listeners = [
        'clearAsset' => 'clearComponent',
    ];

    public function mount()
    {
        $this->assets = [];
    }

    protected function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function clearComponent()
    {
        $this->selectedAsset = null;
        $this->clearAssets();
    }

    protected function updatedInsertedAssetName()
    {
        $this->insertedAssetName = Str::upper($this->insertedAssetName);
    }

    public function changedSearch()
    {
        if ($this->selectedAsset != null) {
            $this->selectedAsset = null;
            $this->dispatchBrowserEvent('new-asset-updated',
                ['name' => '', 'id' => '']
            );
        }
        if ($this->new_asset == '') {
            $this->assets = [];
            return;
        }
        $this->assets = Asset::ofType($this->type)
            ->where('name', 'like', $this->new_asset . '%')
            ->orWhere('name', 'like', Str::upper($this->new_asset) . '%')
            ->limit(5)
            ->get(['id', 'name'])->toArray();
    }

    public function clearAssets()
    {
        if ($this->preventClearing) {
            return;
        }
        if ($this->selectedAsset == null) {
            $assetArray = array_filter($this->assets,
                fn($asset) => $asset['name'] == $this->new_asset);
            if (count($assetArray) == 0) {
                $this->new_asset = '';
            } else {
                $asset = $assetArray[array_key_first($assetArray)];
                $this->assetSelected($asset['id']);
            }
        }
        $this->assets = [];
        $this->showMenu = false;
    }

    public function preventClear()
    {
        $this->showMenu = true;
        $this->preventClearing = true;
        $this->changedSearch();
    }

    public function markClear()
    {
        $this->preventClearing = false;
    }

    public function assetSelected($assetId)
    {
        $assetArray = array_filter($this->assets, fn($asset) => $asset['id'] == $assetId);
        $asset = $assetArray[array_key_first($assetArray)];
        $this->new_asset = $asset['name'];
        $this->selectedAsset = $asset;
        $this->markClear();
        $this->clearAssets();
        $this->dispatchBrowserEvent('new-asset-updated',
            ['name' => $asset['name'], 'id' => $asset['id']]
        );
    }

    public function clearInsertedAssetName()
    {
        $this->insertedAssetName = "";
        $this->resetErrorBag();
    }

    public function insertAsset()
    {
        $this->insertedAssetName = Str::upper($this->insertedAssetName);

        $validate = $this->validate();
        $new = [
            'name' => $validate['insertedAssetName'],
            'type' => $this->type,
            'attributes' => [],
        ];
        $created = Asset::create($new);
        $this->assets = [ $created->toArray() ];
        $this->assetSelected($created->id);

        $this->clearInsertedAssetName();

    }

    public function render()
    {
        return view('livewire.search-asset');
    }
}
