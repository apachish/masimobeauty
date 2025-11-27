<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - MasimoBeauty</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @livewireStyles
</head>
<body>
    @livewire('top-bar', ['showContactInfo' => true])
    @livewire('header')
    
    <!-- Page Banner -->
    <section class="page-banner">
        <div class="banner-overlay">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="separator">></span>
                    <span class="current">Cart</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart Content -->
    @livewire('cart')

    @livewire('footer')
    @livewireScripts
</body>
</html>

