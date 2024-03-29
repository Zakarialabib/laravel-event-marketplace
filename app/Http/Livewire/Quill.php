<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;

class Quill extends Component
{
    final public const EVENT_VALUE_UPDATED = 'quill_value_updated';

    public $value;

    public $quillId;

    public function mount($value): void
    {
        $this->value = $value;
        $this->quillId = 'quill-'.uniqid();
    }

    public function updatedValue($value): void
    {
        $this->emit(self::EVENT_VALUE_UPDATED, $value);
    }

    public function render()
    {
        return view('livewire.quill');
    }
}
