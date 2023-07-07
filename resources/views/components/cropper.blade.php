{{-- cropper.blade.php --}}

@php
$imageCropAspectRatio = $getImageCropAspectRatio();
$imageResizeTargetHeight = $getImageResizeTargetHeight();
$imageResizeTargetWidth = $getImageResizeTargetWidth();
$imageResizeMode = $getImageResizeMode();
$shouldTransformImage = $imageCropAspectRatio || $imageResizeTargetHeight || $imageResizeTargetWidth;
$imageFormat = $getImageFormat();
$imageQuality = $getImageQuality();
@endphp


<div class="relative" x-data="{
fileHasUploaded : false,
fileHasDeleted: false,
}"
>

<div
    x-data="fileUploadFormComponent({
    acceptedFileTypes: {{ json_encode($getAcceptedFileTypes(), JSON_THROW_ON_ERROR) }},
    canDownload: {{ $canDownload() ? 'true' : 'false' }},
    canOpen: {{ $canOpen() ? 'true' : 'false' }},
    canPreview: {{ $canPreview() ? 'true' : 'false' }},
    canReorder: {{ $canReorder() ? 'true' : 'false' }},
    deleteUploadedFileUsing: async (fileKey) => {
        fileHasDeleted = true;
        fileHasUploaded = false;
        return await $wire.deleteUploadedFile('{{ $getStatePath() }}', fileKey)
    },
    getUploadedFileUrlsUsing: async () => {
        return await $wire.getUploadedFileUrls('{{ $getStatePath() }}')
    },
    imageCropAspectRatio: {{ $imageCropAspectRatio ? "'{$imageCropAspectRatio}'" : 'null' }},
    imagePreviewHeight: {{ ($height = $getImagePreviewHeight()) ? "'{$height}'" : 'null' }},
    imageResizeMode: {{ $imageResizeMode ? "'{$imageResizeMode}'" : 'null' }},
    imageResizeTargetHeight: {{ $imageResizeTargetHeight ? "'{$imageResizeTargetHeight}'" : 'null' }},
    imageResizeTargetWidth: {{ $imageResizeTargetWidth ? "'{$imageResizeTargetWidth}'" : 'null' }},
    isAvatar: {{ $isAvatar() ? 'true' : 'false' }},
    loadingIndicatorPosition: '{{ $getLoadingIndicatorPosition() }}',
    locale: @js(app()->getLocale()),
    panelAspectRatio: {{ ($aspectRatio = $getPanelAspectRatio()) ? "'{$aspectRatio}'" : 'null' }},
    panelLayout: {{ ($layout = $getPanelLayout()) ? "'{$layout}'" : 'null' }},
    placeholder: @js($getPlaceholder()),
    maxSize: {{ ($size = $getMaxSize()) ? "'{$size} KB'" : 'null' }},
    minSize: {{ ($size = $getMinSize()) ? "'{$size} KB'" : 'null' }},
    removeUploadedFileUsing: async (fileKey) => {
        fileHasDeleted = true;
        fileHasUploaded = false;
        return await $wire.removeUploadedFile('{{ $getStatePath() }}', fileKey)
    },
    removeUploadedFileButtonPosition: '{{ $getRemoveUploadedFileButtonPosition() }}',
    reorderUploadedFilesUsing: async (files) => {
        return await $wire.reorderUploadedFiles('{{ $getStatePath() }}', files)
    },
    shouldAppendFiles: {{ $shouldAppendFiles() ? 'true' : 'false' }},
    shouldTransformImage: {{ $shouldTransformImage ? 'true' : 'false' }},
    state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},
    uploadButtonPosition: '{{ $getUploadButtonPosition() }}',
    uploadProgressIndicatorPosition: '{{ $getUploadProgressIndicatorPosition() }}',
    uploadUsing: (fileKey, file, success, error, progress) => {
        $wire.upload(`{{ $getStatePath() }}.${fileKey}`, file, () => {
            fileHasUploaded = true;
            fileHasDeleted = false;
            success(fileKey)
        }, error, progress)
    },
})"
    wire:ignore
    {!! ($id = $getId()) ? "id=\"{$id}\"" : null !!}
    style="min-height: {{ $isAvatar() ? '8em' : ($getPanelLayout() === 'compact' ? '2.625em' : '4.75em') }}"
    {{ $attributes->merge($getExtraAttributes())->class([
        'w-32 mx-auto' => $isAvatar(),
    ]) }}
    {{ $getExtraAlpineAttributeBag() }}
>
    <input
        x-ref="input"
        {{ $isDisabled() ? 'disabled' : '' }}
        {{ $isMultiple() ? 'multiple' : '' }}
        type="file"
        {{ $getExtraInputAttributeBag() }}
        dusk="forms.{{ $getStatePath() }}"

    />
</div>

@php
    $uniquemodalevent = \Illuminate\Support\Str::of($getStatePath())->replace('.','')->replace('_','');
@endphp

<input
    {{ $isDisabled() ? 'disabled' : '' }}
    type="file"
    accept="{{\Illuminate\Support\Arr::join($getAcceptedFileTypes(),',','')}}"

    x-show = "(({{$getState() == null  ? 'true':'false'}} && !fileHasUploaded) || fileHasDeleted) || {{$isMultiple()?'true':'false'}}"

    @class([
            'croppie-image-picker',
            "left-0 w-full cursor-pointer" => !$isAvatar(),
            "avatar  w-32  cursor-pointer" => $isAvatar(),
    ])

    type="file"
    x-on:change = "function(){
        var fileType = event.target.files[0]['type'];
        if (!(fileType.search(`image`) >= 0)) {
            new Notification()
            .title('{{ __('error') }}')
                .danger()
                .body('{{ __('invalid') }}')
                .send()
                return;
        }
        $dispatch('on-croppie-modal-show-{{$uniquemodalevent}}', {
            id: 'croppie-modal-{{ $getStatePath() }}',
            files: event.target.files,

        })
    }" />

</div>

<div x-data="{files:null,}" @on-croppie-modal-show-{{ $uniquemodalevent }}.window="
    files = $event.detail.files;
    id = $event.detail.id;
    $dispatch('open-modal', {id: id})"
    class="h-0"
>
<x-modal
    class=""
    width="{{$getModalSize()}}"

    id="croppie-modal-{{ $getStatePath() }}"
>
    @if ($hasModalHeading())
    <x-slot name="heading">
        <x-modal.heading>
            {{$getModalHeading()}}
        </x-modal.heading>
    </x-slot>
    @endif

    <div class=" z-5 w-full h-full flex flex-col justify-between"
         x-data="imageCropper({
                imageUrl: '',
                shape: `{{$isAvatar()?'circle':'square'}}`,
                files: files,
                viewportWidth: `{{$getViewportWidth()}}`,
                viewportHeight: `{{$getViewportHeight()}}`,
                boundaryWidth: `{{$getBoundaryWidth()}}`,
                boundaryHeight: `{{$getBoundaryHeight()}}`,
                statePath: `{{$getStatePath()}}`,
                showZoomer: `{{$getShowZoomer()}}`,
                format: `{{$imageFormat}}`,
                quality: `{{$imageQuality}}`
            })" x-cloak
    >
        <div class="h-full w-full" wire:ignore >
            {{-- init Alpine --}}
            <div class="h-full w-full relative"  >
                <div  x-on:click.prevent class="bg-transparent h-full">
                    <div class="m-auto flex-col" x-ref="croppie"></div>
                    <div class="flex justify-center gap-2 pb-2">
                        @if ($isLeftRotationEnabled())
                            <x-button class="px-2" type="button" secondary  x-on:click.prevent="rotateLeft()">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l-6 6m0 0l-6-6m6 6V9a6 6 0 0112 0v3" />
                                </svg>
                            </x-button>
                        @endif

                        @if ($isRightRotationEnabled())
                        <x-button type="button" secondary x-on:click.prevent="rotateRight()" >
                            <svg style="transform: scale(-1,1)" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l-6 6m0 0l-6-6m6 6V9a6 6 0 0112 0v3" />
                            </svg>
                        </x-button>
                        @endif
                    </div>
                </div>

                <div x-show="!showCroppie" class="absolute top-0 left-0 w-full h-full bg-white z-10 flex items-center justify-center">
                    <div aria-label="{{ __('loading') }}" role="status" class="flex items-center space-x-2">
                        <span class="text-xs font-medium text-gray-500">{{ __('loading') }}</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="flex justify-center items-center gap-2">
            <x-button type="button" primary  x-on:click.prevent="saveCroppie()">
                {{__('Save')}}
            </x-button>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageCropper', (config) => ({
                showCroppie: false,
                hasImage: config.imageUrl.length > 0,
                filename: '',
                filetype: '',
                originalSrc: config.imageUrl,
                viewportWidth: config.viewportWidth,
                viewportHeight: config.viewportHeight,
                boundaryWidth: config.boundaryWidth,
                boundaryHeight: config.boundaryHeight,
                shape: config.shape,
                statePath: config.statePath,
                showZoomer: config.showZoomer,
                format: config.format,
                quality: config.quality,

                croppie: {},
                init() {
                    this.$nextTick(
                        () => {
                            this.initCroppie()
                        }
                    )
                    this.$watch('files', (value) => {
                        this.showCroppie = false
                        this.updatePreview()
                    })
                },
                async updatePreview() {
                    let reader, files = this.files
                    if (files == null || files[0] === undefined) {
                        return;
                    }
                    this.filename = files[0].name;
                    this.filetype = files[0].type

                    reader = new FileReader()
                    reader.onload = (e) => {
                        this.originalSrc = e.target.result
                        this.bindCroppie(e.target.result)
                    }
                    await reader.readAsDataURL(files[0])
                },
                initCroppie() {

                    this.croppie = new Croppie(
                        this.$refs.croppie, {
                            viewport: {
                                width: this.viewportWidth,
                                height: this.viewportHeight,
                                type: this.shape
                            }, //circle or square
                            boundary: {
                                width: this.boundaryWidth,
                                height: this.boundaryHeight
                            }, //default boundary container
                            showZoomer: this.showZoomer,
                            enableResize: false,
                            mouseWheelZoom: 'ctrl',
                            enforceBoundary: true,
                            enableOrientation: true,
                            enableExif: true,
                            format: this.format,
                            quality: this.quality
                        })
                },

                rotateLeft() {
                    this.croppie.rotate(90);
                },

                rotateRight() {
                    this.croppie.rotate(-90);
                },

                saveCroppie() {
                    this.croppie.result({
                        type: "blob",
                        size: "original",
                        format: this.filetype,
                        quality: 1
                    }).then((croppedImage) => {
                        this.showCroppie = false
                        this.hasImage = true
                        let input = document.getElementById(this.statePath)
                            .getElementsByTagName('input')[0]
                        let event = new Event('change');
                        let fileName = this.filename;
                        let filetype = this.filetype;
                        let file = new File(
                            [croppedImage],
                            fileName, {
                                type: filetype,
                                lastModified: new Date().getTime()
                            },
                            'utf-8'
                        );
                        let container = new DataTransfer();
                        container.items.add(file);

                        input.files = container.files;
                        this.$dispatch("close-modal", {
                            id: "croppie-modal-" + this.statePath,
                            files: null
                        })
                        input.dispatchEvent(event);
                    })
                },
                bindCroppie(src) {
                    //avoid problems with croppie container not being visible when binding
                    setTimeout(() => {
                        this.croppie.bind({
                            url: src,
                            orientation: 1
                        })
                        setTimeout(() => {
                            this.showCroppie = true
                        }, 200)
                    }, 200)
                }
            }))
        })
    </script>
@endpush
