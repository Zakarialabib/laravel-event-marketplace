<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Sponsor;

use App\Models\Sponsor;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createSponsor;

    public $sponsor;

    /** @var mixed */
    public $image;

    public $image_url = null;

    public $listeners = ['createSponsor'];

    protected $rules = [
        'sponsor.name'        => ['required', 'string', 'max:255'],
        'sponsor.description' => ['nullable', 'string'],
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('sponsor_create'), 403);

        return view('livewire.admin.sponsors.create');
    }

    public function createSponsor()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->sponsor = new Sponsor();

        $this->createSponsor = true;
    }

    public function create()
    {
        $this->validate();

        $this->sponsor->slug = Str::slug($this->sponsor->name);

        if ($this->image_url) {
            $image = file_get_contents($this->image_url);

            $imageName = Str::slug($this->sponsor->name);

            $this->sponsor->addMediaFromDisk($image->getRealPath())
                ->usingFileName($imageName)
                ->toMediaCollection('local_files');

            $this->sponsor->image = $imageName;
        }

        if ($this->image) {
            // with str slug with name date
            $imageName = Str::slug($this->sponsor->name).'.'.$this->image->extension();

            $this->sponsor->addMediaFromDisk($this->image->getRealPath())
                ->usingFileName($imageName)
                ->toMediaCollection('local_files');

            $this->sponsor->image = $imageName;
        }

        $this->sponsor->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Sponsor created successfully.'));

        $this->createSponsor = false;
    }
}
