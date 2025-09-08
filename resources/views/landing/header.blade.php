<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">

    <div class="container">
      
      <a class="navbar-brand text-primary fw-bold d-flex align-items-center" href="/">
        <i class="fas fa-heartbeat me-2"></i>DRISHTI PULSE
      </a>
      {{-- <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="{{ asset('frontend/assets/logo/Drishti Pulse-111.png') }}" 
         alt="Drishti Pulse Logo" 
         class="img-fluid">
    </a> --}}
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <!-- Left-aligned navigation items -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/#features">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/#how-it-works">How It Works</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/#pricing">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('documentation.page') }}">User Docs</a>
          </li>
        </ul>
        
        <!-- Right-aligned items -->
        <div class="d-flex align-items-center">
          <!-- Feedback button -->
          <button class="btn btn-link text-decoration-none me-3" data-feedbear-button>
            <i class="far fa-comment-dots me-1"></i> Feedback
          </button>
          
          <!-- Auth buttons -->
          @if (Route::has('login'))
            @auth
              {{-- @hasrole('superadmin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">Admin Dashboard</a>
              @else
                <a href="{{ route('monitoring.dashboard') }}" class="btn btn-primary btn-sm">Dashboard</a>
              @endhasrole --}}
              
              @can('see.admin_dashboard')
              <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">Admin Dashboard</a>
              @else
                  <a href="{{ route('monitoring.dashboard') }}" class="btn btn-primary btn-sm">Dashboard</a>
              @endcan
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