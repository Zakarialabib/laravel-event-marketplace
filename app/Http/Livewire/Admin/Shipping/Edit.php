<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Shipping;

use App\Models\Shipping;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;

    public $shipping;

    public $editModal = false;

    public $langauges;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'shipping.is_pickup' => ['nullable', 'boolean'],
        'shipping.title'     => ['required', 'string', 'max:255'],
        'shipping.subtitle'  => ['nullable', 'string'],
        'shipping.cost'      => ['required', 'string'],
        // 'shipping.language_id' => ['required', 'integer'],
    ];

    public function render(): View|Factory
    {
        return view('livewire.admin.shipping.edit');
    }

    public function editModal($shipping): void
    {
        // abort_if(Gate::denies('shipping_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->shipping = Shipping::findOrFail($shipping);

        $this->editModal = true;
    }

    public function update(): void
    {
        // abort_if(Gate::denies('shipping_update'), 403);

        $this->validate();

        $this->shipping->save();

        $this->alert('success', __('Shipping updated successfully'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }
}
