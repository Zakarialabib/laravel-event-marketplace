<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibrary extends Component
{
    public $model;
    public $category;
    public $mediaItems;

    public function mount($model = null)
    {
        $this->model = $model; // race parametre for example --> App\Models\Race
        $this->category = null;
        $this->refreshMediaItems();
    }

    public function render()
    {
        $mediaItems = $this->model
            ? $this->model->getMedia('local_files')
            : collect();
    
        return view('livewire.media-library', [
            'models' => $this->getModels(),
            'categories' => $this->getCategories(),
            'mediaItems' => $mediaItems,
        ]);
    }    

    protected function refreshMediaItems()
    {
        
        $this->mediaItems = Media::where('model_type', $this->model)
            ->where('collection_name', 'local_files')
            ->when($this->category, function ($query, $category) {
                return $query->where('custom_properties->category', $category);
            })
            ->get();
    }

    // public function updatedModel($model)
    // {
    //     $this->model = $model;
    //     $this->category = null;
    //     $this->refreshMediaItems();
    // }

    // public function updatedCategory($category)
    // {
    //     $this->category = $category;
    //     $this->refreshMediaItems();
    // }

    protected function getModels()
    {
        // Add your desired models to the array
        return [
            'App\Models\Race' => 'Race',
            'App\Models\RaceLocation' => 'RaceLocation',
            'App\Models\Category' => 'Category',
            // Add more models as needed
        ];
    }

    protected function getCategories()
    {

        if ($this->model === 'App\Models\Race') {
            return [
                'category1' => 'Category 1',
                'category2' => 'Category 2',
            ];
        } elseif ($this->model === 'App\Models\User') {
            return [
                'category3' => 'Category 3',
                'category4' => 'Category 4',
            ];
        }

        // Return default categories or an empty array if no categories are available
        return [];
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
