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

    public $createModaal;

    public $sponsor;

    /** @var mixed */
    public $image;

    public $image_url = null;

    public $listeners = ['createModaal'];

    protected $rules = [
        'sponsor.name'        => ['required', 'string', 'max:255'],
        'sponsor.description' => ['nullable', 'string'],
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('sponsor_create'), 403);

        return view('livewire.admin.sponsors.create');
    }

    public function createModaal()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->sponsor = new Sponsor();

        $this->createModaal = true;
    }

    public function create()
    {
        $this->validate();

        $this->sponsor->slug = Str::slug($this->sponsor->name);

        if ($this->image_url) {
            $imageName = Str::slug($this->sponsor->name);

            $this->sponsor->addMediaFromDisk($this->image_url->getRealPath())
                ->usingFileName($imageName)
                ->toMediaCollection('local_files');

            $this->sponsor->image = $imageName;
        }

        if ($this->image) {
            // with str slug with name date
            $imageName = Str::slug($this->sponsor->name).'.'.$this->image->extension();

            $this->sponsor->addMediaFromDisk($this->image)
                ->usingFileName($imageName)
                ->toMediaCollection('local_files');

            $this->sponsor->image = $imageName;
        }

        $this->sponsor->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Sponsor created successfully.'));

        $this->createModaal = false;
    }
}
