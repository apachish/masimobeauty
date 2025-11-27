<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MasimoBeauty - Cosmetics & Beauty</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @livewireStyles
</head>
<body>
    @livewire('top-bar')
    @livewire('header')
    @livewire('hero')
    @livewire('about')
    @livewire('categories')
    @livewire('new-arrivals')
    @livewire('collection-organic')
    @livewire('beauty-foundation')
    @livewire('best-seller')
    @livewire('features')
    @livewire('newsletter')
    @livewire('partners')
    @livewire('footer')

    @livewireScripts
</body>
</html>
