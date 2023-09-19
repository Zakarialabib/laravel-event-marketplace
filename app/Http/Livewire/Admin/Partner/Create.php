<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Partner;

use App\Models\Partner;
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

    public $createModal;

    public $partner;

    public $image;

    public $image_url;

    public $listeners = ['createModal'];

    protected $rules = [
        'partner.name'        => ['required', 'string', 'max:255'],
        'partner.description' => ['nullable', 'string'],
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('partner_create'), 403);

        return view('livewire.admin.partner.create');
    }

    public function createModal(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->partner = new Partner();

        $this->createModal = true;
    }

    public function create(): void
    {
        $this->validate();

        $this->partner->slug = Str::slug($this->partner->name);

        if ($this->image_url) {
            $image = file_get_contents($this->image_url);

            $imageName = Str::random(5).'.'.$this->image->extension();

            $this->partner->addMedia($image)->toMediaCollection('local_files');

            $this->partner->image = $imageName;
        }

        if ($this->image) {
            // with str slug with name date
            $imageName = Str::slug($this->partner->name).'.'.$this->image->extension();

            $this->partner->addMedia($this->image)->toMediaCollection('local_files');

            $this->partner->image = $imageName;
        }

        $this->partner->save();

        $this->alert('success', __('Partner created successfully.'));

        $this->emit('refreshIndex');

        $this->createModal = false;
    }
}
