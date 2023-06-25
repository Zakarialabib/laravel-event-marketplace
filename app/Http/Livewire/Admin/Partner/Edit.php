<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Partner;

use App\Models\Partner;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $partner;

    public $editModal = false;

    public $image;

    public $featured_image;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'partner.name'        => ['required', 'string', 'max:255'],
        'partner.slug'        => ['required', 'string'],
        'partner.description' => ['nullable', 'string'],
    ];

    public function getImagePreviewProperty()
    {
        return $this->partner?->image;
    }

    public function getFeaturedImagePreviewProperty()
    {
        return $this->partner?->featured_image;
    }

    public function editModal($partner)
    {
        abort_if(Gate::denies('partner_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->partner = Partner::findOrfail($partner);

        $this->editModal = true;
    }

    public function update()
    {
        abort_if(Gate::denies('partner_update'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->partner->name).'-'.Str::random(5).'.'.$this->image->extension();

            $this->partner->clearMediaCollection('partners');

            $this->partner->addMedia($this->image)->toMediaCollection('local_files');

            $this->partner->image = $imageName;
        }

        $this->partner->save();

        $this->alert('success', __('Partner updated successfully.'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.partner.edit');
    }
}
