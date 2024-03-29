<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Trix extends Component
{
    use WithFileUploads;

    final public const EVENT_VALUE_UPDATED = 'trix_value_updated';

    public $value;

    public $trixId;

    public $photos = [];

    public function mount($value = ''): void
    {
        $this->value = $value;
        $this->trixId = 'trix-'.uniqid();
    }

    public function updatedValue($value): void
    {
        $this->emit(self::EVENT_VALUE_UPDATED, $this->value);
    }

    public function completeUpload(string $uploadedUrl, string $trixUploadCompletedEvent): void
    {
        foreach ($this->photos as $photo) {
            if ($photo->getFilename() == $uploadedUrl) {
                // store in the public/photos location
                $newFilename = $photo->store('public/photos');

                // get the public URL of the newly uploaded file
                $url = Storage::url($newFilename);

                $this->dispatchBrowserEvent($trixUploadCompletedEvent, [
                    'url'  => $url,
                    'href' => $url,
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.trix');
    }
}
