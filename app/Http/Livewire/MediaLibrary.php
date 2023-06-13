<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibrary extends Component
{
    public $model;
    public $models;
    public $mediaItems;
    public $cropData = [
        'x' => 0,
        'y' => 0,
        'width' => 0,
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

        // Example: Save the cropped image
        $image = Image::make($this->selectedImage);
        $image->crop($width, $height, $x, $y);
        $image->save('path/to/save/cropped-image.jpg');

        // Clear crop data
        $this->cropData = [
            'x' => 0,
            'y' => 0,
            'width' => 0,
            'height' => 0,
        ];
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
                $this->mediaItems =  Media::where('model_type', 'App\Models\Race')
                ->where('collection_name', 'local_files')
                ->get();
                break;
            case 'Race Location':
                $this->mediaItems =  Media::where('model_type', 'App\Models\RaceLocation')
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
            'App\Models\Race' => 'Race',
            'App\Models\RaceLocation' => 'Race Location',
            // Add more models as needed
        ];
    }

    public function deleteMedia($mediaId)
    {
        $media = Media::find($mediaId);

        if ($media) {
            Storage::disk($media->disk)->delete($media->getPath());

            $media->delete();

            $this->refreshMediaItems();
        }
    }
}
