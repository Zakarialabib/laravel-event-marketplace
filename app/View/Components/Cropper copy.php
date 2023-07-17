<?php

declare(strict_types=1);

namespace Nuhel\FilamentCropper\Components;

use Closure;
use App\View\Components\FileUpload;
use App\Tratis\Cropper\CanGenerateThumbnail;
use App\Tratis\Cropper\CanRotateImage;
use App\Tratis\Cropper\CanFlipImage;
use App\Tratis\Cropper\CanZoomImage;
use App\Tratis\Cropper\HasAspectRatio;
use App\Tratis\Cropper\HasViewMode;
use App\Enums\DragMode;

class Cropper extends FileUpload
{
    use CanFlipImage;
    use CanRotateImage;
    use CanZoomImage;
    use HasViewMode;
    use HasAspectRatio;
    use CanGenerateThumbnail;

    protected string $view = 'components.cropper';

    protected string|Closure|null $imageResizeTargetHeight = '400';

    protected string|Closure|null $imageResizeTargetWidth = '400';

    protected DragMode|Closure $dragMode;

    public function getAcceptedFileTypes(): ?array
    {
        if (parent::getAcceptedFileTypes() == null) {
            $this->acceptedFileTypes([
                'image/png', ' image/gif', 'image/jpeg',
            ]);
        }

        return parent::getAcceptedFileTypes();
    }

    public function dragMode(DragMode|Closure $dragMode): static
    {
        $this->dragMode = $dragMode;

        return $this;
    }

    public function getDragMode(): DragMode
    {
        if (empty($this->dragMode)) {
            return DragMode::NONE;
        }

        return $this->evaluate($this->dragMode);
    }
}
