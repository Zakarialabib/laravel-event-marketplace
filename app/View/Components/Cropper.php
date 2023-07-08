<?php

declare(strict_types=1);

namespace App\Views\Components;

use Closure;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Cropper extends Media
{
    protected string $view = 'components.cropper';

    protected string|Closure|null $viewportHeight = '400';

    protected string|Closure|null $viewportWidth = '400';

    protected string|Closure|null $boundaryHeight = '600';

    protected string|Closure|null $boundarywidth = '100%';

    protected string|Closure|null $modalSize = '6xl';

    protected string|Closure|null $modalHeading = null;

    protected bool|Closure $isLeftRotationEnabled = false;

    protected bool|Closure $isRightRotationEnabled = false;

    protected bool|Closure $showZoomer = false;

    protected string|Closure $imageFormat = 'png';

    protected float|Closure $imageQuality = 0.9;

    public function getAcceptedFileTypes(): ?array
    {
        $this->acceptedFileTypes([
            'image/png', ' image/gif', 'image/jpeg', 'image/webp',
        ]);

        return parent::getAcceptedFileTypes();
    }

    public function enableImageRotation(bool|Closure $condition = true): static
    {
        $this->isRightRotationEnabled = $condition;

        $this->isLeftRotationEnabled = $condition;

        return $this;
    }

    public function enableRightImageRotation(bool|Closure $condition = true): static
    {
        $this->isRightRotationEnabled = $condition;

        return $this;
    }

    public function isRightRotationEnabled(): mixed
    {
        return $this->evaluate($this->isRightRotationEnabled);
    }

    public function enableLeftImageRotation(bool|Closure $condition = true): static
    {
        $this->isLeftRotationEnabled = $condition;

        return $this;
    }

    public function isLeftRotationEnabled(): mixed
    {
        return $this->evaluate($this->isLeftRotationEnabled);
    }

    public function showZoomer(bool|Closure $condition = true): static
    {
        $this->showZoomer = $condition;

        return $this;
    }

    public function getShowZoomer(): bool
    {
        return $this->evaluate($this->showZoomer);
    }

    public function viewportHeight(string|Closure|null $height): static
    {
        $this->viewportHeight = $height;

        return $this;
    }

    public function getViewportHeight(): string
    {
        return $this->evaluate($this->viewportHeight);
    }

    public function viewportWidth(string|Closure|null $width): static
    {
        $this->viewportWidth = $width;

        return $this;
    }

    public function getViewportWidth(): string
    {
        return $this->evaluate($this->viewportWidth);
    }

    public function boundaryHeight(string|Closure|null $height): static
    {
        $this->boundaryHeight = $height;

        return $this;
    }

    public function getBoundaryHeight(): string
    {
        return $this->evaluate($this->boundaryHeight);
    }

    public function boundaryWidth(string|Closure|null $width): static
    {
        $this->boundarywidth = $width;

        return $this;
    }

    public function getBoundaryWidth(): string
    {
        return $this->evaluate($this->boundarywidth);
    }

    public function imageFormat(string|Closure $imageFormat = 'png'): static
    {
        $this->imageFormat = $imageFormat;

        return $this;
    }

    public function getImageFormat(): string
    {
        return $this->evaluate($this->imageFormat);
    }

    public function imageQuality(float|Closure $imageQuality = 0.9): static
    {
        $this->imageQuality = $imageQuality;

        return $this;
    }

    public function getImageQuality(): float
    {
        return $this->evaluate($this->imageQuality);
    }
}
