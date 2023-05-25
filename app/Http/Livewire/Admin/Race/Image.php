<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Race;

use App\Models\Race;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Image extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $race;

    public $images = [];

    public $image_url = null;

    public $imageModal = false;
    
    public $listeners = [
        'imageModal', 'saveImage',
    ];
    
    protected $rules = [
        'images'    => ['required', 'array'],
    ];


    public function imageModal($id)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->race = Race::findOrFail($id);
        $this->images = $this->race->getMedia('local_files');
        // dd($this->images);
        $this->imageModal = true;
    }

    public function saveImage()
    {

            if ($this->image_url) {

                $imageName = Str::random(10).'.jpg';
                
                $this->race->addMediaFromUrl($this->image_url)->toMediaCollection('local_files');

                $this->race->image = $imageName;
            }
            
            if ($this->images) {
                foreach ($this->images as $image) {
                    $this->race->addMedia($image->getRealPath())->toMediaCollection('local_files');
                }
            }

            $this->race->save();

            $this->alert('success', __('Race image updated successfully.'));

            $this->emit('refreshIndex');

            $this->imageModal = false;

        
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.race.image');
    }
}
