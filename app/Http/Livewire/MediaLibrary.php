<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibrary extends Component
{
    public $model;

    public $editModal = false;

    public $media;

    public $models;

    public $mediaItems;

    public $image;

    public function editMedia($id): void
    {
        $this->media = Media::findOrFail($id);
        $this->editModal = true;
    }

    public function deleteMedia($id): void
    {
        $media = Media::findOrFail($id);
        Storage::disk($media->disk)->delete($media->getPath());
        $media->delete();

        $this->refreshMediaItems();
    }

    public function mount($model = null): void
    {
        $this->model = $model ?? 'Race';
        $this->models = $this->getModels();
        $this->refreshMediaItems();
    }

    public function render()
    {
        return view('livewire.media-library');
    }

    public function updatedModel($model): void
    {
        $this->model = $model;
        $this->refreshMediaItems();
    }

    protected function refreshMediaItems()
    {
        $this->mediaItems = match ($this->model) {
            'Race' => Media::where('model_type', \App\Models\Race::class)
                ->where('collection_name', 'local_files')
                ->get(),
            'Race Location' => Media::where('model_type', \App\Models\RaceLocation::class)
                ->where('collection_name', 'local_files')
                ->get(),
            default => collect(),
        };
    }

    protected function getModels(): array
    {
        return [
            \App\Models\Race::class         => 'Race',
            \App\Models\RaceLocation::class => 'Race Location',
            // Add more models as needed
        ];
    }

    public function setActiveImage($index): void
    {
        $media = $this->mediaItems[$index - 1];
        $this->image = $media->getUrl();
    }
}
