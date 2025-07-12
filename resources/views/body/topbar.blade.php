
@push('styles')
    <style>
    
    /* .dropdown-item{
        border-bottom: none !important;
    } */
    </style>
    
@endpush

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 white-color">
        <i class="fa fa-bars"></i>
    </button>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto d-flex align-items-center justify-content-center">
        @hasanyrole(['user', 'subuser'])
            <li class="nav-item dropdown no-arrow mx-1 d-none d-sm-inline-block" id="helpDropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    style="padding: 10px 15px; font-size: 1rem; font-weight: 600;">
                    <i class="fas fa-question-circle mr-2 white-color" style="font-size: 1.2rem; color:#555879;"></i>
                    <span class="text-gray-600">Help</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="helpDropdown">
                    @if (request()->is('dashboard*') || request()->is('ssl-check*') || request()->is('monitoring/add*'))
                        <a class="dropdown-item" id="startTourBtn" style="cursor: pointer;">
                            <i class="fas fa-play mr-2"></i> Start Tour
                        </a>
                    @endif
                    <a class="dropdown-item" href="{{ url('/raise/tickets') }}">
                        <i class="fas fa-bug mr-2"></i> Report an Issue
                    </a>
                    <a class="dropdown-item" href="{{ url('/documentation') }}">
                        <i class="fas fa-info-circle mr-2"></i> For more info
                    </a>
                </div>
            </li>

            <!-- dark mode button  -->

         <button id="darkModeToggle" class="ml-2 mr-2">
            <i id="themeIcon" class="fas fa-moon"></i>
        </button>

           
            <!-- Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw notification-bell" style="color: #084bbf;"></i>
                    @php
                        $unreadCount = auth()->user()->unreadNotifications->count();
                    @endphp

                    <span class="badge badge-danger badge-counter {{ $unreadCount === 0 ? 'd-none' : '' }}"
                        id="notificationCounter">
                        {{ $unreadCount }}
                    </span>

                </a>

                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Notification Center
                    </h6>
                    <div id="notificationList">
                        @forelse(auth()->user()->notifications->take(4) as $notification)
                            <a class="dropdown-item d-flex align-items-start" 
                                href="{{ $notification->data['url'] ?? '#' }}" style="border: none;">
                                <div class="mr-3">

                                    @php
                                        $type = $notification->data['type'] ?? 'info';
                                        $iconMap = [
                                            'alert' => ['color' => 'danger', 'icon' => 'exclamation-triangle'],
                                            'announcement' => ['color' => 'info', 'icon' => 'bullhorn'],
                                            'update' => ['color' => 'warning', 'icon' => 'sync-alt'],
                                        ];
                                        $color = $iconMap[$type]['color'] ?? 'primary';
                                        $icon = $iconMap[$type]['icon'] ?? 'info-circle';
                                    @endphp

                                    <div class="icon-circle bg-{{ $color }}">
                                        <i class="fas fa-{{ $icon }} text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small text-gray-700">{{ $notification->created_at->diffForHumans() }}</div>
                                    <span class="font-weight-bold">{{ $notification->data['message'] }}</span>
                                    @if (isset($notification->data['type']) && $notification->data['type'] !== 'info')
                                        <span
                                            class="badge badge-{{ $notification->data['type'] === 'alert' ? 'danger' : 'warning' }} ml-2">
                                            {{ ucfirst($notification->data['type']) }}
                                        </span>
                                    @endif
                                </div>
                            </a>
                        @empty
                            <span class="dropdown-item text-center text-muted py-3">No notifications yet.</span>
                        @endforelse
                    </div>
                </div>
            </li>
        @endhasanyrole

         

        <!--User profile-->
        <li class="nav-item">
            <a class="d-flex align-items-center text-decoration-none auth-name" href="{{ url('/profile') }}"
                role="button" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-lg-inline text-gray-600 small white-color" style="cursor: default;">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle profile"
                    src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                    style="width: 35px !important; height: 35px !important; object-fit: cover; border-radius: 50%;">
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw fa-rotate-180  text-gray-600 white-color"></i>
            </a>
        </li>

    </ul>

</nav>
