<?php

declare(strict_types=1);

namespace App\Traits;

trait ForModels
{
    /** @param mixed $selectedModels */
    public function forModels($selectedModels)
    {
        $this->models = $selectedModels;

        return $this;
    }
}
