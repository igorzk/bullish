<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowPdf extends Component
{
    public $file;
    public $filePath;
    public function showFile()
    {
        Gate::authorize('view-files');
        $this->file = base64_encode(Storage::get($this->filePath));
    }
    public function render()
    {
        return view('livewire.show-pdf');
    }
}
