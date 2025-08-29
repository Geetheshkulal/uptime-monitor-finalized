<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Cookies | Drishti Pulse</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- PWA -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#6777ef">
    <link rel="apple-touch-icon" href="{{ asset('mainlogo.png') }}">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>

        :root {
            --primary-color: #5d75ca;
            --secondary-color: #4e73df;
            --accent-color: #4cc9f0;
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
        }

        html,
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .btn {
            border-radius: 50px !important;
            padding: 12px 28px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
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
            background-color: white !important;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }

        .footer-links a {
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer-links a:hover {
            color: var(--accent-color) !important;
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

        .terms-content {
      font-size: 0.95rem;
      line-height: 1.7;
    }

        .transition {
            transition: all 0.3s ease;
        }

        .hover-opacity-100:hover {
            opacity: 1 !important;
        }

        .hover-text-primary:hover {
            color: #0d6efd !important;
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

        @media (max-width: 768px) {
      .terms-content h1, .terms-content h2 {
        font-size: 1.5rem;
      }
      .terms-content {
        font-size: 0.9rem;
      }
    }
        @media (max-width: 578px) {
            .auth-buttons .btn {
                margin-top: 20px;
                padding: 10px 10px !important;
                font-size: 15px !important;
            }

            .auth-buttons i {
                font-size: 14px;
            }
        }

        .navbar-toggler:focus {
            box-shadow: none !important;
        }

        p {
  line-height: 2; 
}

h1,h2,h3,h4{
  line-height: 1.8; 
}

  </style>
</head>

<body>
       <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">

    <div class="container">
      
      <a class="navbar-brand text-primary fw-bold d-flex align-items-center" href="/">
        <i class="fas fa-heartbeat me-2"></i>DRISHTI PULSE
      </a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <!-- Left-aligned navigation items -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/#features') }}">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/#how-it-works') }}">How It Works</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/#pricing') }}">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('documentation.page') }}">User Docs</a>
          </li>
        </ul>
        
        <!-- Right-aligned items -->
        <div class="d-flex align-items-center">
          
          <!-- Auth buttons -->
          @if (Route::has('login'))
            @auth
              @hasrole('superadmin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">Admin Dashboard</a>
              @else
                <a href="{{ route('monitoring.dashboard') }}" class="btn btn-primary btn-sm">Dashboard</a>
              @endhasrole
            @else
            <div class="auth-buttons d-flex">
            <a href="{{ route('login') }}" class="btn btn-primary btn-sm me-2">
              <i class="fas fa-sign-in-alt me-1"></i> Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
              <i class="fas fa-user-plus me-1"></i> Register
            </a>
          </div>
            @endauth 
          @endif
        </div>
      </div>
    </div>
  </nav>

    <section id="terms" class="py-5 bg-light">
        <div class="container terms-content mt-5">
            <h1 class="mb-3">Cookies Policy</h1>
            <p>Last updated: August 26, 2025</p>
            <p>This Cookies Policy explains what Cookies are and how We use them. You should read this policy so You can understand what type of cookies We use, or the information We collect using Cookies and how that information is used.</p>
            <p>Cookies do not typically contain any information that personally identifies a user, but personal information that we store about You may be linked to the information stored in and obtained from Cookies. For further information on how We use, store and keep your personal data secure, see our Privacy Policy.</p>
            <p>We do not store sensitive personal information, such as mailing addresses, account passwords, etc. in the Cookies We use.</p>
            <h2>Interpretation and Definitions</h2>
            <h3>Interpretation</h3>
            <p>The words with their initial letter capitalized have specific meanings as defined below. These definitions apply whether the terms appear in singular or plural..</p>
            <h3>Definitions</h3>
            <p>For the purposes of this Cookies Policy:</p>
            <ul>
            <li><strong>Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in this Cookies Policy) refers to Drishti pulse.</li>
            <li><strong>Cookies</strong> means small files that are placed on Your computer, mobile device or any other device by a website, containing details of your browsing history on that website among its many uses.</li>
            <li><strong>Website</strong> refers to Drishti pulse, accessible from <a href="https://drishtipulse.in/" rel="external nofollow noopener" target="_blank">https://drishtipulse.in/</a></li>
            <li><strong>You</strong> means the individual accessing or using the Website, or a company, or any legal entity on behalf of which such individual is accessing or using the Website, as applicable.</li>
            </ul>
            <h2>The use of the Cookies</h2>
            <h3>Type of Cookies We Use</h3>
            <p>Cookies can be &quot;Persistent&quot; or &quot;Session&quot; Cookies. Persistent Cookies remain on your personal computer or mobile device when You go offline, while Session Cookies are deleted as soon as You close your web browser.</p>
            <p>We use a combination of session and persistent cookies for different purposes, including development and security:</p>
            <ul>
            <li>
            <p><strong>Necessary / Essential Cookies</strong></p>
            <p>Type: Session Cookies</p>
            <p>Examples: session, XSRF-TOKEN, PHPSESSID</p>
            <p>Purpose: These Cookies are essential to provide You with services available through the Website and to enable You to use some of its features. They help to authenticate users and prevent fraudulent use of user accounts. Without these Cookies, the services that You have asked for cannot be provided, and We only use these Cookies to provide You with those services.</p>
            </li>
            <li>
            <p><strong>Analytics Cookies</strong></p>
            <p>Type: Persistent Cookies</p>
            <p>Purpose:Monitor website traffic and performance.Help improve user experience by tracking user behavior anonymously.
            Behavior: These cookies stay in your browser until they expire or are manually cleared.</p>
            </li>
            </ul>
            <h3>Your Choices Regarding Cookies</h3>
            <p>If You prefer to avoid the use of Cookies on the Website, first You must disable the use of Cookies in your browser and then delete the Cookies saved in your browser associated with this website. You may use this option for preventing the use of Cookies at any time.</p>
            <p>If You do not accept Our Cookies, You may experience some inconvenience in your use of the Website and some features may not function properly.</p>
            <p>If You'd like to delete Cookies or instruct your web browser to delete or refuse Cookies, please visit the help pages of your web browser.</p>
            <ul>
            <li>
            <p>For the Chrome web browser, please visit this page from Google: <a href="https://support.google.com/accounts/answer/32050" rel="external nofollow noopener" target="_blank">https://support.google.com/accounts/answer/32050</a></p>
            </li>
            <li>
            <p>For the Internet Explorer web browser, please visit this page from Microsoft: <a href="http://support.microsoft.com/kb/278835" rel="external nofollow noopener" target="_blank">http://support.microsoft.com/kb/278835</a></p>
            </li>
            <li>
            <p>For the Firefox web browser, please visit this page from Mozilla: <a href="https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored" rel="external nofollow noopener" target="_blank">https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored</a></p>
            </li>
            <li>
            <p>For the Safari web browser, please visit this page from Apple: <a href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac" rel="external nofollow noopener" target="_blank">https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac</a></p>
            </li>
            </ul>
            <p>For any other web browser, please visit your web browser's official web pages.</p>
            <h3>Contact Us</h3>
            <p>If you have any questions about this Cookies Policy, You can contact us:</p>
            <ul>
            <li>By visiting this page on our website: <a href="https://drishtipulse.in/" rel="external nofollow noopener" target="_blank">https://drishtipulse.in/</a></li>
            </ul>
        </div>
    </section>

   <!-- Footer -->
   <footer class="bg-dark text-light py-5">
    <div class="container">
      <div class="row gy-4">
        
        <!-- Company Info -->
        <div class="col-lg-3 col-md-6">
          <div class="d-flex align-items-center mb-3">
            <i class="fas fa-heartbeat text-primary me-2 fs-4"></i>
            <h3 class="h5 fw-bold mb-0">DRISHTI PULSE</h3>
          </div>
          <p class="mb-3 text-muted">Enterprise-grade website monitoring for businesses of all sizes.</p>
          <!-- <div class="d-flex gap-3">
            <a href="#" class="social-icon text-light opacity-75 hover-opacity-100 transition">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon text-light opacity-75 hover-opacity-100 transition">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="#" class="social-icon text-light opacity-75 hover-opacity-100 transition">
              <i class="fab fa-linkedin"></i>
            </a>
            <a href="#" class="social-icon text-light opacity-75 hover-opacity-100 transition">
              <i class="fab fa-github"></i>
            </a>
          </div> -->
        </div>
  
        <!-- Product Links -->
        <div class="col-lg-3 col-md-6">
          <h3 class="h6 fw-bold mb-3 text-uppercase small text-muted">Product</h3>
          <div class="d-flex flex-column gap-2 footer-links">
            <a href="#features" class="text-light text-decoration-none hover-text-primary transition">
              <i class="fas fa-chevron-right me-1 text-primary opacity-50 fs-8"></i> Features
            </a>
            <a href="#pricing" class="text-light text-decoration-none hover-text-primary transition">
              <i class="fas fa-chevron-right me-1 text-primary opacity-50 fs-8"></i> Pricing
            </a>
            <a href="/changelog" class="text-light text-decoration-none hover-text-primary transition">
              <i class="fas fa-chevron-right me-1 text-primary opacity-50 fs-8"></i> Changelog
            </a>
          </div>
        </div>

         <!-- Useful Links -->
         <div class="col-lg-3 col-md-6">
          <h3 class="h6 fw-bold mb-3 text-uppercase small text-muted">Useful Links</h3>
          <div class="d-flex flex-column gap-2 footer-links">
            <a href="{{ route('privacy') }}" class="text-light text-decoration-none hover-text-primary transition">
              <i class="fas fa-chevron-right me-1 text-primary opacity-50 fs-8"></i> Privacy Policy
            </a>
            <a href="{{ route('terms') }}" class="text-light text-decoration-none hover-text-primary transition">
              <i class="fas fa-chevron-right me-1 text-primary opacity-50 fs-8"></i> Terms of Service
            </a>
            <a href="{{ route('cookies') }}" class="text-light text-decoration-none hover-text-primary transition">
              <i class="fas fa-chevron-right me-1 text-primary opacity-50 fs-8"></i> Cookies Policy
            </a>
          </div>
        </div>
      
        
        <!-- Contact Information - Added to fill empty space -->
        <div class="col-lg-3 col-md-6">
          <h3 class="h6 fw-bold mb-3 text-uppercase small text-muted">Contact Us</h3>
          <div class="d-flex flex-column gap-2">
            <p class="mb-3 d-flex align-items-start">
              <i class="fas fa-map-marker-alt text-primary me-2 mt-1"></i>
              <a 
                href="https://www.google.com/maps/place/Mangalore" 
                target="_blank"
                class="text-light text-decoration-none hover-text-primary transition"
              >D IT Solutions Pvt. Ltd.
              VSK Towers, 3rd Floor,
              Kottara Chowki,
              Mangaluru,
              Karnataka
              575 006
                {{-- <span>Mangalore, Karnataka, India</span> --}}
              </a>
            </p>
            <p class="mb-1 d-flex align-items-center">
              <i class="fas fa-envelope text-primary me-2"></i>
              <a href="mailto:info@ditsolutions.net" class="text-light text-decoration-none hover-text-primary transition">info@ditsolutions.net</a>
            </p>
            <p class="mb-1 d-flex align-items-center">
              <i class="fas fa-phone text-primary me-2"></i>
              <a href="+91 8073462033" class="text-light text-decoration-none hover-text-primary transition">+91 8073462033</a>
            </p>
            {{-- <div class="mt-2">
              <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">
                <i class="fas fa-rocket me-2"></i> Start Your Free Trial
              </a>
            </div> --}}
          </div>
        </div>
      </div>
  
      <!-- Footer Divider -->
      <hr class="my-4 bg-opacity-10">
  
      <!-- Copyright & Legal Links -->
      {{-- <div class="row align-items-center">
        <div class="col-md-8 text-center text-md-start">
          <p class="mb-md-0 text-muted small">© 2025 | All rights reserved, Drishti Pulse | Powered By D IT Solutions Pvt. Ltd. Made with ❤️ in BHARAT.</p>
            
        </div>
        <div class="col-md-4 text-center text-md-end">
          <a href="{{ route('privacy') }}" class="text-light text-decoration-none me-3 hover-text-primary transition small">Privacy Policy</a>
          <a href="{{ route('terms') }}" class="text-light text-decoration-none hover-text-primary transition small">Terms of Service</a>
          <a href="{{ route('cookies') }}" class="text-light text-decoration-none ms-3 hover-text-primary transition small">Cookies Policy</a>
        </div>
      </div> --}}
      <div class="row align-items-center">
        <div class="col-md-12 text-center mt-3">
          <p class="text-muted small mb-0">© 2025 | All rights reserved, Drishti Pulse | Powered By D IT Solutions Pvt. Ltd.</p>   
          <span class="text-muted bold">Made with ❤️ in BHARAT.</span>
        </div>
      </div>
    </div>
  </footer>


    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>
