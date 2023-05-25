@props(['value'])

@php
    $editorId = 'editor-' . uniqid();
@endphp

<div wire:ignore>
    <textarea id="{{ $editorId }}" wire:model.lazy="{{ $value }}"></textarea>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css"
        integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"
        integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            $('#{{ $editorId }}').trumbowyg({
                    btns: [
                        ['viewHTML'],
                        ['undo', 'redo'], // Only supported in Blink browsers
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        ['superscript', 'subscript'],
                        ['horizontalRule'],
                        ['fullscreen'],
                        ['bold', 'italic', 'underline', 'strikethrough'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['unorderedList', 'orderedList'],
                        ['link', 'insertImage'],
                        ['removeformat']
                    ],
                    autogrow: true
                })
                .on('tbwchange', function() {
                    Livewire.emit('trumbowygEditorUpdated', $('#{{ $editorId }}').trumbowyg('html'));
                });
        });
    </script>
@endpush
