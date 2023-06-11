<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    public $file;
    public $inputName;
    public $required;

    protected $rules = [
        'file' => 'mimes:pdf|max:10240'
    ];

    protected $messages = [
        'file.mimes' => 'arquivo deve ter formato pdf',
        'file.max' => 'arquivo excedeu limite máximo de 10 MB',
    ];

    public function updatedFile()
    {
        $this->validate();
    }

    use WithFileUploads;

    public function render()
    {
        return view('livewire.file-upload');
    }
}
