<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('storage/photos/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/css/styles.css') }}">
    <title>Responsive pizza website - Bedimcode</title>
    @livewireStyles
</head>
<body>
    <livewire:header />
    
    
    <main class="main">
        {{ $slot }}
    </main>
    
    <livewire:footer />
    
    
    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-line"></i>
    </a>

    <!-- Scripts -->
    <script src="{{ asset('js/js/scrollreveal.min.js')}}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js')}}"></script>
    <script src="{{ asset('js/js/main.js')}}"></script>
    @livewireScripts
</body>
</html>