<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>DRISHTI PULSE - Website Monitoring Service</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- PWA  -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#6777ef">
    <link rel="apple-touch-icon" href="{{ asset('mainlogo.png') }}">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Google Fonts -->
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">  
    {{-- <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet"> --}}

</head>

<style>
    :root {
        /* --primary-color: #5d75ca; */
        --primary-color:  #52C41A;
        /* --secondary-color: #4e73df; */
        --secondary-color:  #f9f9f9;
        --secondary-color-button: #0ABFBC;
        --text-color: #000000;
        --accent-color: #4cc9f0;
        --dark-color: #1a1a2e;
        --light-color: #f8f9fa;
    }

    html,
    body {
        font-family: 'Poppins', sans-serif;
        /* font-family: 'Audiowide', sans-serif; */
        overflow-x: hidden;
    }

    .gradient-bg {
        /* background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); */
        background: var(--secondary-color)
    }



    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.05);
            opacity: 0.8;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }



    .testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid var(--primary-color);
    }



    .popular-badge {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--accent-color);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 0.8rem;
        box-shadow: 0 5px 15px rgba(76, 201, 240, 0.4);
    }



    .btn {
        border-radius: 50px !important;
        padding: 12px 28px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        letter-spacing: 0.5px;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color-button) 100%) ;
        border: none;
        /* color: var(--text-color); */
        /* box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4); */
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.6);
    }

    .btn-light {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-light:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .navbar {
        padding: 15px 0;
        transition: all 0.3s ease;
    }

    .navbar.scrolled {
        background-color: var(--secondary-color) !important;
        /* box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); */
        padding: 10px 0;
    }

    .highlight-text {
        background: linear-gradient(90deg, var(--primary-color) 0%, var(--accent-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    .up {
        background: #4ade80;
    }

    .down {
        background: #f87171;
    }

    .warning {
        background: #fbbf24;
    }

    .glow {
        filter: drop-shadow(0 0 10px rgba(67, 97, 238, 0.5));
    }

    .footer-links a {
        transition: all 0.3s ease;
        display: inline-block;
    }

    .footer-links a:hover {
        color: var(--primary-color) !important;
        transform: translateX(5px);
    }

    .social-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: var(--accent-color);
        transform: translateY(-5px);
    }

    .transition {
        transition: all 0.3s ease;
    }

    .hover-opacity-100:hover {
        opacity: 1 !important;
    }

    .text-primary{
        color: var(--text-color) !important;
    }
    .text-primary-icon{
        color: var(--primary-color) ;
    }

    .hover-text-primary:hover {
        /* color: #0d6efd !important; */.
        color: var(--primary-color) !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .bg-opacity-10 {
        opacity: 0.1;
    }

    .fs-8 {
        font-size: 0.7rem;
    }


    @media (max-width: 400px) {
        .auth-buttons .btn {
            padding: 4px 8px !important;
            font-size: 12px !important;
        }

        .auth-buttons i {
            font-size: 10px;
        }

    }

    @media (max-width: 578px) {
        .navbar-light{
            background-color: var(--light-color) !important;
        }

    }

    .navbar-toggler:focus {
        box-shadow: none !important;
    }

    .navbar-brand img {
    max-height: 50px;
    width: auto;
}


</style>
@stack('styles')


@if (session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
@endif

<body>
    <!-- Navigation -->
    @include('landing.header')

    <!-- Hero Section -->
    @yield('content')

    <!-- Footer -->
    @include('landing.footer')

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery and Toastr scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // Navbar scroll effect

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('scrolled');
            } else {
                document.querySelector('.navbar').classList.remove('scrolled');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Animation on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate__animated');

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;

                if (elementPosition < screenPosition) {
                    const animationClass = element.classList[1];
                    element.classList.add(animationClass);
                }
            });
        }

        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>

    {{-- for feedbear --}}
    <script>
        (function(w, d, s, o, f, js, fjs) {
            w[o] = w[o] || function() {
                (w[o].q = w[o].q || []).push(arguments)
            };
            js = d.createElement(s), fjs = d.getElementsByTagName(s)[0];
            js.id = o;
            js.src = f;
            js.async = 1;
            fjs.parentNode.insertBefore(js, fjs);
        }(window, document, 'script', 'FeedBear', 'https://sdk.feedbear.com/widget.js'));
        FeedBear("button", {
            element: document.querySelector("[data-feedbear-button]"),
            project: "drishti-pulse",
            board: "feature-requests",
            jwt: null
        });
    </script>

    {{-- <script type="module">
     
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/11.9.1/firebase-app.js";
        import {
            getAnalytics
        } from "https://www.gstatic.com/firebasejs/11.9.1/firebase-analytics.js";

        const firebaseConfig = {
            apiKey: "AIzaSyDWS_Xf7irpvt1Z0yz-0fSOfMipACTM3tw",
            authDomain: "check-my-site01.firebaseapp.com",
            projectId: "check-my-site01",
            storageBucket: "check-my-site01.firebasestorage.app",
            messagingSenderId: "73799490679",
            appId: "1:73799490679:web:f6f7c801cdf20ff31e3a72",
            measurementId: "G-FMM15QNKS4"
        };

   
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
    </script> --}}

</body>

</html>
