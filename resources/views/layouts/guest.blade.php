<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'MasimoBeauty - Cosmetics & Beauty') }}</title>
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/frontend/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">

{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            [x-cloak] { display: none !important; }
        </style>
        @livewireStyles
    </head>
    <body>
{{--    class="font-sans text-gray-900 antialiased"--}}
{{--        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">--}}
{{--            <div>--}}
{{--                <a href="/" wire:navigate>--}}
{{--                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">--}}
<livewire:layout.navigation />

{{ $slot }}
{{--            </div>--}}
{{--        </div>--}}



@livewire('footer')

@livewireScripts

    </body>
</html>
