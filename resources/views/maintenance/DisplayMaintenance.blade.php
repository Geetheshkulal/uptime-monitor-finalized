@extends('dashboard')
@section('content')

    <head>
        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/introjs.min.css"/>

        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    </head>

    <div class="d-flex justify-content-center align-items-center flex-column" style="height: 75vh;">
        <lottie-player 
            src="{{ asset('animations/gear.json') }}"  
            background="transparent"  
            speed="1"  
            style="width: 300px; height: 300px;"  
            loop  
            autoplay>
        </lottie-player>
    
        <h2 class="mt-3 text-center">
            <i class="fas fa-tools text-warning"></i> This feature is under development
        </h2>
        <p class="text-muted text-center">We’ll be back soon with something awesome. Stay tuned!</p>
    </div>

       
@endsection
