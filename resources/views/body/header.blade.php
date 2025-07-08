<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>@yield('title', 'DRISHTI PULSE')</title>

    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <meta name="theme-color" content="#6777ef">
    <link rel="apple-touch-icon" href="{{ asset('mainlogo.png') }}">


    <!-- Service Worker -->
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js', {
                    scope: '/'
                })
                .then(reg => console.log('Service Worker registered:', reg.scope))
                .catch(err => console.error('Service Worker registration failed:', err));
        }
    </script>

    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                // document.body.classList.add('dark-mode');
                document.documentElement.classList.add('dark-mode');
            }
        })();
    </script>

    <!-- Fonts and styles -->
    <link href="{{ asset('frontend/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">


    <!-- Skeleton Loader Styles -->
    <style>
        *:not(.status-dot):not(.status-badge, .status-indicator, .bar-segment, .badge, .whatsapp-bubble, .telegram-bubble):not(#login-spinner):not(#profile-photo):not(.icon-circle) {
            border-radius: 0 !important;
        }


        .scroll-to-top {
            width: 40px;
            height: 40px;
            bottom: 20px;
            right: 20px;
        }

        .skeleton {
            position: relative;
            background-color: whitesmoke;
            border-radius: 0.4rem;
        }

        .skeleton.sm {
            height: 16px;
            width: 30%;
            margin-bottom: 8px;
        }

        .skeleton.md {
            height: 20px;
            width: 60%;
            margin-bottom: 10px;
        }

        .skeleton.lg {
            height: 24px;
            width: 100%;
            margin-bottom: 12px;
        }

        .skeleton * {
            visibility: hidden;
        }

        .skeleton::after {
            content: "";
            position: absolute;
            top: 0;
            left: -150px;
            width: 150px;
            height: 100%;
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0.5) 50%,
                    rgba(255, 255, 255, 0) 100%);
            animation: shimmer 1.2s infinite ease-in-out;
        }

        @keyframes shimmer {
            0% {
                left: -150px;
            }

            100% {
                left: 100%;
            }
        }

        @import url("https://fonts.googleapis.com/css2?family=Montserrat&display=swap");

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Montserrat", sans-serif;
            background-color: #fff;
            transition: background 0.2s linear;
        }

        .checkbox {
            opacity: 0;
            position: absolute;
        }

        .checkbox-label {
            background-color: #111;
            width: 50px;
            height: 26px;
            border-radius: 50px;
            position: relative;
            padding: 5px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .checkbox-label .ball {
            background-color: #fff;
            width: 22px;
            height: 22px;
            position: absolute;
            left: 2px;
            top: 2px;
            border-radius: 50%;
            transition: transform 0.2s linear;
        }

        .checkbox:checked+.checkbox-label .ball {
            transform: translateX(24px);
        }

        #helpDropdown {
            padding: 10px 15px;
            font-size: 1rem;
            font-weight: 600;
        }

        #helpDropdown i {
            font-size: 1.2rem;
        }

        /* Notification styles */
        .badge-counter {
            position: absolute;
            transform: scale(0.7);
            transform-origin: top right;
            right: 2.25rem;
            margin-top: -0.25rem;
            font-size: small;
        }

        .pulse {
            animation: pulse 1s;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.7);
            }

            50% {
                transform: scale(1);
            }

            100% {
                transform: scale(0.7);
            }
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dropdown-list {
            width: 20rem !important;
            max-height: 80vh;
            overflow-y: auto;
        }

        .dropdown-list .dropdown-item {
            white-space: normal;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }

        .dropdown-list .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-list .dropdown-item:last-child {
            border-bottom: none;
        }

        .flex-grow-1 {
            flex-grow: 1;
        }

        #helpDropdown .fa-caret-down {
            font-size: 0.9rem;
            margin-left: 5px;
            color: #090a19 !important;
        }

        @media (max-width: 480px) {

            .hide-on-mobile {
                display: none !important;
            }

        }
    </style>


    @include('layouts.darkmode-style')
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
