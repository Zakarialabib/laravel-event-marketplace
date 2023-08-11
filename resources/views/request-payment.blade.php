<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>CMI Payement Request</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        *,
        :after,
        :before {
            border: 0 solid #e5e7eb;
            box-sizing: border-box
        }

        :after,
        :before {
            --tw-content: ""
        }

        html {
            -webkit-text-size-adjust: 100%;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5;
            -moz-tab-size: 4;
            tab-size: 4
        }

        body {
            line-height: inherit;
            margin: 0
        }

        hr {
            border-top-width: 1px;
            color: inherit;
            height: 0
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b,
        strong {
            font-weight: bolder
        }

        code,
        kbd,
        pre,
        samp {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, Liberation Mono, Courier New, monospace;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            border-collapse: collapse;
            border-color: inherit;
            text-indent: 0
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            color: inherit;
            font-family: inherit;
            font-size: 100%;
            line-height: inherit;
            margin: 0;
            padding: 0
        }

        button,
        select {
            text-transform: none
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: baseline
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote,
        dd,
        dl,
        figure,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        p,
        pre {
            margin: 0
        }

        fieldset {
            margin: 0
        }

        fieldset,
        legend {
            padding: 0
        }

        menu,
        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::-moz-placeholder,
        textarea::-moz-placeholder {
            color: #9ca3af;
            opacity: 1
        }

        input:-ms-input-placeholder,
        textarea:-ms-input-placeholder {
            color: #9ca3af;
            opacity: 1
        }

        input::placeholder,
        textarea::placeholder {
            color: #9ca3af;
            opacity: 1
        }

        [role=button],
        button {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        audio,
        canvas,
        embed,
        iframe,
        img,
        object,
        svg,
        video {
            display: block;
            vertical-align: middle
        }

        img,
        video {
            height: auto;
            max-width: 100%
        }

        [hidden] {
            display: none
        }

        *,
        :after,
        :before {
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-scroll-snap-strictness: proximity;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgba(59, 130, 246, .5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .mt-2 {
            margin-top: .5rem
        }

        .flex {
            display: flex
        }

        .hidden {
            display: none
        }

        .h-20 {
            height: 5rem
        }

        .min-h-full {
            min-height: 100%
        }

        .w-full {
            width: 100%
        }

        .w-auto {
            width: auto
        }

        .max-w-7xl {
            max-width: 80rem
        }

        .flex-shrink-0 {
            flex-shrink: 0
        }

        .flex-grow {
            flex-grow: 1
        }

        .flex-col {
            flex-direction: column
        }

        .justify-center {
            justify-content: center
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255/var(--tw-bg-opacity))
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem
        }

        .py-16 {
            padding-bottom: 4rem
        }

        .pt-16,
        .py-16 {
            padding-top: 4rem
        }

        .pb-12 {
            padding-bottom: 3rem
        }

        .text-center {
            text-align: center
        }

        .text-sm {
            font-size: .875rem;
            line-height: 1.25rem
        }

        .text-3xl {
            font-size: 1.875rem;
            line-height: 2.25rem
        }

        .text-base {
            font-size: 1rem;
            line-height: 1.5rem
        }

        .font-medium {
            font-weight: 500
        }

        .font-semibold {
            font-weight: 600
        }

        .uppercase {
            text-transform: uppercase
        }

        .tracking-wide {
            letter-spacing: .025em
        }

        .tracking-tight {
            letter-spacing: -.025em
        }

        .text-red-600 {
            --tw-text-opacity: 1;
            color: rgb(220 38 38/var(--tw-text-opacity))
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39/var(--tw-text-opacity))
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128/var(--tw-text-opacity))
        }
    </style>
</head>

<body>
    <div class="min-h-full pt-16 pb-12 flex flex-col bg-white">
        <main class="flex-grow flex flex-col justify-center max-w-7xl w-full mx-auto px-4">
            <div class="flex-shrink-0 flex justify-center">
                <img class="h-20 w-auto"
                    src="data:image/jpeg;base64,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"
                    alt="">
            </div>
            <div class="py-16">
                <div class="text-center">
                    <p class="text-sm font-medium text-red-600 uppercase tracking-wide">{{ __('CMI Maroc') }}</p>
                    <h1 class="mt-2 text-3xl font-semibold text-gray-900 tracking-tight">
                        {{ __('Authentification de la requête en cours...') }}</h1>
                    <p class="mt-2 text-base text-gray-500">
                        {{ __('Vous allez être redirigé vers la page de paiement') }}</p>
                </div>
            </div>
        </main>
    </div>

    <form name="payForm" id="payForm" method="post" action="{{ $cmiClient->getBaseUri() }}">
        @foreach ($payData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ trim($value) }}">
        @endforeach
        <input type="hidden" name="HASH" value="{{ $hash }}">
    </form>

    <script type="text/javascript">
        document.getElementById("payForm").submit();
    </script>
</body>

</html>
