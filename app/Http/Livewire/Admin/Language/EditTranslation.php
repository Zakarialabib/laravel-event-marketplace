<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Language;

use Livewire\Component;
use App\Models\Language;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\HttpFoundation\Exception\JsonException;

class EditTranslation extends Component
{
    use LivewireAlert;

    public $language;

    public $translations;

    public $rules = [
        'translations.*.value' => 'required',
    ];

    public function mount($code): void
    {
        $this->language = Language::where('code', $code)->firstOrFail();
        $this->translations = $this->getTranslations();
        $this->translations = collect($this->translations)->map(static function ($item, $key): array {
            return [
                'key'   => $key,
                'value' => $item,
            ];
        })->toArray();
    }

    private function getTranslations()
    {
        $path = base_path(sprintf('lang/%s.json', $this->language->code));
        $content = file_get_contents($path);

        return json_decode($content, true);
    }

    public function updateTranslation(): void
    {
        $this->validate();

        $path = base_path(sprintf('lang/%s.json', $this->language->code));

        if ( ! file_exists($path)) {
            $this->alert('error', __('File does not exist!'));

            return;
        }

        try {
            $json = file_get_contents($path);
            $translations = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            $this->alert('error', __('Error decoding JSON data!'));

            return;
        }

        foreach ($this->translations as $translation) {
            if (array_key_exists($translation['key'], $translations)) {
                $this->alert('error', __('Translation key already exists!'));

                return;
            }

            $translations[$translation['key']] = $translation['value'];
        }

        try {
            file_put_contents($path, json_encode($translations, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        } catch (JsonException) {
            $this->alert('error', __('Error encoding JSON data!'));

            return;
        }

        $this->alert('success', __('Data created successfully!'));
    }

    public function render()
    {
        return view('livewire.admin.language.edit-translation')->extends('layouts.dashboard');
    }
}
