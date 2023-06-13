<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Livewire\WithFileUploads;

class MultipleUploads extends Component
{
    use WithFileUploads;

    public $images = [];

    public string $inputId;

    protected $listeners = [
        'fileDeleted' => 'render',
    ];

    protected $rules = [
        'images.*' => 'nullable|max:5120',
    ];

    public function mount($images = []): void
    {
        $this->images = $images;
        $this->inputId = 'images-upload-' . uniqid();
    }

    public function updatedimages(array $images): void
    {
        $imagesUrl = collect();

        foreach ($images as $image) {
            $imagesUrl->push($image->getRealPath());
        }

        $this->emitUp('imagesUpdated', $imagesUrl);
    }

    public function removeMedia(int $id): void
    {
        Media::query()->find($id)->delete();

        $this->emitSelf('fileDeleted');
    }

    public function render(): View
    {
        return view('livewire.multiple-uploads');
    }
}
