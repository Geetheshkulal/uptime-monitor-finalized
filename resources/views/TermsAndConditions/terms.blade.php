<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Terms of Service | Drishti Pulse</title>

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
            /* color: var(--accent-color) !important; */
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
    {{-- <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold d-flex align-items-center" href="/">
                <i class="fas fa-heartbeat me-2"></i>DRISHTI PULSE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex align-items-center ms-auto">
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
    </nav> --}}

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
            <h1 class="mb-3">Terms of service</h1>
            <p class="text-muted">Last updated: August 25, 2025</p>
            <p>Please read these terms and conditions carefully before using Our Service.</p>
            <h2>Interpretation and Definitions</h2>
            <h3>Interpretation</h3>
            <p>The words of which the initial letter is capitalized have meanings defined under the following
                conditions. The following definitions shall have the same meaning regardless of whether they appear in
                singular or in plural.</p>
            <h3>Definitions</h3>
            <p>For the purposes of these Terms and Conditions:</p>
            <ul>
                <li>
                    <p><strong>Affiliate</strong> means an entity that controls, is controlled by or is under common
                        control with a party, where &quot;control&quot; means ownership of 50% or more of the shares,
                        equity interest or other securities entitled to vote for election of directors or other managing
                        authority.</p>
                </li>
                <li>
                    <p><strong>Country</strong> refers to: Karnataka, India</p>
                </li>
                <li>
                    <p><strong>Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;,
                        &quot;Us&quot; or &quot;Our&quot; in this Agreement) refers to Damodar IT Solutions Pvt. Ltd.,
                        Damodar IT Solutions Pvt. Ltd, 3rd Floor, VSK Towers, Kottara Chowki, Mangaluru, Karnataka, 575
                        006..</p>
                </li>
                <li>
                    <p><strong>Device</strong> means any device that can access the Service such as a computer, a
                        cellphone or a digital tablet.</p>
                </li>
                <li>
                    <p><strong>Service</strong> refers to the Website.</p>
                </li>
                <li>
                    <p><strong>Terms and Conditions</strong> (also referred as &quot;Terms&quot;) mean these Terms and
                        Conditions that form the entire agreement between You and the Company regarding the use of the
                        Service.</p>
                </li>
                <li>
                    <p><strong>Third-party Social Media Service</strong> means any services or content (including data,
                        information, products or services) provided by a third-party that may be displayed, included or
                        made available by the Service.</p>
                </li>
                <li>
                    <p><strong>Website</strong> refers to Drishti Pulse, accessible from <a
                            href="https://drishtipulse.in/" rel="external nofollow noopener"
                            target="_blank">https://drishtipulse.in/</a></p>
                </li>
                <li>
                    <p><strong>You</strong> means the individual accessing or using the Service, or the company, or
                        other legal entity on behalf of which such individual is accessing or using the Service, as
                        applicable.</p>
                </li>
            </ul>
            <h2>Acknowledgment</h2>
            <p>These are the Terms and Conditions governing the use of this Service and the agreement that operates
                between You and the Company. These Terms and Conditions set out the rights and obligations of all users
                regarding the use of the Service.</p>
            <p>Your access to and use of the Service is conditioned on Your acceptance of and compliance with these
                Terms and Conditions. These Terms and Conditions apply to all visitors, users and others who access or
                use the Service.</p>
            <p>By accessing or using the Service You agree to be bound by these Terms and Conditions. If You disagree
                with any part of these Terms and Conditions then You may not access the Service.</p>
            <p>You represent that you are over the age of 18. The Company does not permit those under 18 to use the
                Service.</p>
            <p>Your access to and use of the Service is also conditioned on Your acceptance of and compliance with the
                Privacy Policy of the Company. Our Privacy Policy describes Our policies and procedures on the
                collection, use and disclosure of Your personal information when You use the Application or the Website
                and tells You about Your privacy rights and how the law protects You. Please read Our Privacy Policy
                carefully before using Our Service.</p>
            <h2>Links to Other Websites</h2>
            <p>Our Service may contain links to third-party web sites or services that are not owned or controlled by
                the Company.</p>
            <p>The Company has no control over, and assumes no responsibility for, the content, privacy policies, or
                practices of any third party web sites or services. You further acknowledge and agree that the Company
                shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to
                be caused by or in connection with the use of or reliance on any such content, goods or services
                available on or through any such web sites or services.</p>
            <p>We strongly advise You to read the terms and conditions and privacy policies of any third-party web sites
                or services that You visit.</p>
            <h2>Termination</h2>
            <p>We may terminate or suspend Your access immediately, without prior notice or liability, for any reason
                whatsoever, including without limitation if You breach these Terms and Conditions.</p>
            <p>Upon termination, Your right to use the Service will cease immediately.</p>
            <h2>Limitation of Liability</h2>
            <p>Notwithstanding any damages that You might incur, the entire liability of the Company and any of its
                suppliers under any provision of this Terms and Your exclusive remedy for all of the foregoing shall be
                limited to the amount actually paid by You through the Service or 100 USD if You haven't purchased
                anything through the Service.</p>
            <p>To the maximum extent permitted by applicable law, in no event shall the Company or its suppliers be
                liable for any special, incidental, indirect, or consequential damages whatsoever (including, but not
                limited to, damages for loss of profits, loss of data or other information, for business interruption,
                for personal injury, loss of privacy arising out of or in any way related to the use of or inability to
                use the Service, third-party software and/or third-party hardware used with the Service, or otherwise in
                connection with any provision of this Terms), even if the Company or any supplier has been advised of
                the possibility of such damages and even if the remedy fails of its essential purpose.</p>
            <p>Some states do not allow the exclusion of implied warranties or limitation of liability for incidental or
                consequential damages, which means that some of the above limitations may not apply. In these states,
                each party's liability will be limited to the greatest extent permitted by law.</p>
            <h2>&quot;AS IS&quot; and &quot;AS AVAILABLE&quot; Disclaimer</h2>
            <p>The Service is provided to You &quot;AS IS&quot; and &quot;AS AVAILABLE&quot; and with all faults and
                defects without warranty of any kind. To the maximum extent permitted under applicable law, the Company,
                on its own behalf and on behalf of its Affiliates and its and their respective licensors and service
                providers, expressly disclaims all warranties, whether express, implied, statutory or otherwise, with
                respect to the Service, including all implied warranties of merchantability, fitness for a particular
                purpose, title and non-infringement, and warranties that may arise out of course of dealing, course of
                performance, usage or trade practice. Without limitation to the foregoing, the Company provides no
                warranty or undertaking, and makes no representation of any kind that the Service will meet Your
                requirements, achieve any intended results, be compatible or work with any other software, applications,
                systems or services, operate without interruption, meet any performance or reliability standards or be
                error free or that any errors or defects can or will be corrected.</p>
            <p>Without limiting the foregoing, neither the Company nor any of the company's provider makes any
                representation or warranty of any kind, express or implied: (i) as to the operation or availability of
                the Service, or the information, content, and materials or products included thereon; (ii) that the
                Service will be uninterrupted or error-free; (iii) as to the accuracy, reliability, or currency of any
                information or content provided through the Service; or (iv) that the Service, its servers, the content,
                or e-mails sent from or on behalf of the Company are free of viruses, scripts, trojan horses, worms,
                malware, timebombs or other harmful components.</p>
            <p>Some jurisdictions do not allow the exclusion of certain types of warranties or limitations on applicable
                statutory rights of a consumer, so some or all of the above exclusions and limitations may not apply to
                You. But in such a case the exclusions and limitations set forth in this section shall be applied to the
                greatest extent enforceable under applicable law.</p>
            <h2>Governing Law</h2>
            <p>The laws of the Country, excluding its conflicts of law rules, shall govern this Terms and Your use of
                the Service. Your use of the Application may also be subject to other local, state, national, or
                international laws.</p>
            <h2>Disputes Resolution</h2>
            <p>If You have any concern or dispute about the Service, You agree to first try to resolve the dispute
                informally by contacting the Company.</p>
            <h2>For European Union (EU) Users</h2>
            <p>If You are a European Union consumer, you will benefit from any mandatory provisions of the law of the
                country in which You are resident.</p>
            <h2>United States Legal Compliance</h2>
            <p>You represent and warrant that (i) You are not located in a country that is subject to the United States
                government embargo, or that has been designated by the United States government as a &quot;terrorist
                supporting&quot; country, and (ii) You are not listed on any United States government list of prohibited
                or restricted parties.</p>
            <h2>Severability and Waiver</h2>
            <h3>Severability</h3>
            <p>If any provision of these Terms is held to be unenforceable or invalid, such provision will be changed
                and interpreted to accomplish the objectives of such provision to the greatest extent possible under
                applicable law and the remaining provisions will continue in full force and effect.</p>
            <h3>Waiver</h3>
            <p>Except as provided herein, the failure to exercise a right or to require performance of an obligation
                under these Terms shall not affect a party's ability to exercise such right or require such performance
                at any time thereafter nor shall the waiver of a breach constitute a waiver of any subsequent breach.
            </p>
            <h2>Translation Interpretation</h2>
            <p>These Terms and Conditions may have been translated if We have made them available to You on our Service.
                You agree that the original English text shall prevail in the case of a dispute.</p>
            <h2>Changes to These Terms and Conditions</h2>
            <p>We reserve the right, at Our sole discretion, to modify or replace these Terms at any time. If a revision
                is material We will make reasonable efforts to provide at least 30 days' notice prior to any new terms
                taking effect. What constitutes a material change will be determined at Our sole discretion.</p>
            <p>By continuing to access or use Our Service after those revisions become effective, You agree to be bound
                by the revised terms. If You do not agree to the new terms, in whole or in part, please stop using the
                website and the Service.</p>
            <h2>Contact Us</h2>
            <p>If you have any questions about these Terms and Conditions, You can contact us:</p>
            <ul>
                <li>
                    <p>By email: <a href="mailto:info@ditsolutions.net" class="text-decoration-none">info@ditsolutions.net</a>
                    </p>
                </li>
                <li>
                    <p>By visiting this page on our website: <a href="https://drishtipulse.in/"
                            rel="external nofollow noopener" target="_blank" class="text-decoration-none">https://drishtipulse.in/</a></p>
                </li>
                <li>
                    <p>By phone number: 8073 462 033</p>
                </li>
            </ul>
            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
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
              <a href="/#features" class="text-light text-decoration-none hover-text-primary transition">
                <i class="fas fa-chevron-right me-1 text-primary opacity-50 fs-8"></i> Features
              </a>
              <a href="/#pricing" class="text-light text-decoration-none hover-text-primary transition">
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
                <a href="tel:+91 8073462033" class="text-light text-decoration-none hover-text-primary transition">+91 8073462033</a>
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
