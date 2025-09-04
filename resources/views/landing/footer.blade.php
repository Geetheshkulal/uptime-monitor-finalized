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
