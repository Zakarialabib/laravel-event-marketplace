<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Partners;

use App\Models\Partner;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibraryPro\Http\Livewire\Concerns\WithMedia;

class Create extends Component
{
    use WithMedia;
    use LivewireAlert;
    use WithFileUploads;

    public $createPartner;

    public $partner;

    public $image;

    public $featured_image;

    public $image_url = null;

    public $listeners = ['createPartner'];

    protected $rules = [
        'partner.name'        => ['required', 'string', 'max:255'],
        'partner.description' => ['nullable', 'string'],
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('partner_create'), 403);

        return view('livewire.admin.partners.create');
    }

    public function createPartner()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->partner = new Partner();

        $this->createPartner = true;
    }

    public function create()
    {
        $this->validate();

        $this->partner->slug = Str::slug($this->partner->name);

        if ($this->image_url) {
            $image = file_get_contents($this->image_url);

            $imageName = Str::random(5).'.'.$this->image->extension();
            
            $this->partner->addFromMediaLibraryRequest($image)
            ->toMediaCollection('partners');

            $this->partner->image = $imageName;
        }

        if ($this->image) {
            // with str slug with name date
            $imageName = Str::slug($this->partner->name).'.'.$this->image->extension();
            
            $this->partner->addFromMediaLibraryRequest($this->image)
            ->toMediaCollection('partners');

            $this->partner->image = $imageName;
        }

        if ($this->featured_image) {
            $imageName = Str::slug($this->partner->name).'-'.date('Y-m-d H:i:s').'.'.$this->featured_image->extension();
            $this->featured_image->storeAs('partners', $imageName);
            $this->partner->featured_image = $imageName;
        }

        $this->partner->save();

        $this->alert('success', __('Partner created successfully.'));

        $this->emit('refreshIndex');

        $this->createPartner = false;
    }
}
