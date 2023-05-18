<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Partners;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class Edit extends Component
{
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

        $this->partner = Brand::findOrfail($partner);

        $this->editModal = true;
    }

    public function update()
    {
        abort_if(Gate::denies('partner_update'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->partner->name).'-'.Str::random(5).'.'.$this->image->extension();
            $width = 500;
            $height = 500;

            $img = Image::make($this->image->getRealPath())->encode('webp', 85);

            if ($img->width() > $width) {
                $img->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            if ($img->height() > $height) {
                $img->resize(null, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $img->resizeCanvas($width, $height, 'center', false, '#ffffff');

            $img->stream();

            Storage::disk('local_files')->put('partners/'.$imageName, $img, 'public');

            $this->partner->image = $imageName;
        }

        if ($this->featured_image) {
            $imageName = Str::slug($this->partner->name).'-'.date('Y-m-d H:i:s').'.'.$this->featured_image->extension();
            $this->featured_image->storeAs('partners', $imageName);
            $this->partner->featured_image = $imageName;
        }

        $this->partner->save();

        $this->alert('success', __('Brand updated successfully.'));

        $this->resetErrorBag();

        $this->resetValidation();

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.partners.edit');
    }
}
