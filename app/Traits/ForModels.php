<?php

declare(strict_types=1);

namespace App\Traits;

trait ForModels
{
    public function forModels(mixed $selectedModels)
    {
        $this->models = $selectedModels;

        return $this;
    }
}
