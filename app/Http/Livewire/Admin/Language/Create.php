<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Language;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class Create extends Component
{
    use LivewireAlert;

    public $listeners = ['createLanguage'];

    public array $languages = [];

    public $language;

    public $name;

    public $code;

    public $createLanguage = false;

    protected $rules = [
        'name' => 'required|max:191',
        'code' => 'required',
    ];

    public function createLanguage(): void
    {
        $this->createLanguage = true;
    }

    public function create(): void
    {
        $this->validate();

        $this->language->save();

        File::copy(App::langPath().('/en.json'), App::langPath().('/'.$this->code.'.json'));

        $this->alert('success', __('Language created successfully!'));

        $this->emit('resetIndex');

        $this->createLanguage = false;
    }

    public function render()
    {
        return view('livewire.admin.language.create');
    }
}
