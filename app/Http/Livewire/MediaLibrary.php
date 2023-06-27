<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Intervention\Image\Facades\Image;

class MediaLibrary extends Component
{
    public $model;
    public $editModal = false;
    public $media;
    public $models;
    public $mediaItems;

    public $cropData = [
        'x'      => 0,
        'y'      => 0,
        'width'  => 0,
        'height' => 0,
    ];

    public function cropImage()
    {
        // Access crop data
        $x = $this->cropData['x'];
        $y = $this->cropData['y'];
        $width = $this->cropData['width'];
        $height = $this->cropData['height'];

        // Perform cropping operations based on the crop data
        $image = Image::make($this->media->getPath());
        $image->crop($width, $height, $x, $y);
        $image->save();

        // Clear crop data
        $this->cropData = [
            'x'      => 0,
            'y'      => 0,
            'width'  => 0,
            'height' => 0,
        ];
        $this->editModal = false;
        // Refresh media items
        $this->refreshMediaItems();
    }

    public function editMedia($id)
    {
        $this->media = Media::findOrFail($id);
        $this->editModal = true;
    }

    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);
        Storage::disk($media->disk)->delete($media->getPath());
        $media->delete();

        // Refresh media items
        $this->refreshMediaItems();
    }

    public function mount($model = null)
    {
        $this->model = $model ?? 'Race';
        $this->models = $this->getModels();
        $this->refreshMediaItems();
    }

    public function render()
    {
        return view('livewire.media-library');
    }

    public function updatedModel($model)
    {
        $this->model = $model;
        $this->refreshMediaItems();
    }

    protected function refreshMediaItems()
    {
        switch ($this->model) {
            case 'Race':
                $this->mediaItems = Media::where('model_type', 'App\Models\Race')
                    ->where('collection_name', 'local_files')
                    ->get();

                break;
            case 'Race Location':
                $this->mediaItems = Media::where('model_type', 'App\Models\RaceLocation')
                    ->where('collection_name', 'local_files')
                    ->get();

                break;
                // Add more cases for other models as needed
            default:
                $this->mediaItems = collect();

                break;
        }
    }

    protected function getModels()
    {
        return [
            'App\Models\Race'         => 'Race',
            'App\Models\RaceLocation' => 'Race Location',
            // Add more models as needed
        ];
    }
}
