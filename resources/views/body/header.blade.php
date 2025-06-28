{{-- @extends('layouts.app') --}}

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">

@push('styles')
  <style>
      @import url("https://fonts.googleapis.com/css2?family=Montserrat&display=swap");
    
      * { box-sizing: border-box; }
    
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
    
      .checkbox:checked + .checkbox-label .ball {
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

#helpDropdown .fa-caret-down {
    font-size: 0.9rem;
    margin-left: 5px;
}


</style>

<style>
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
        0% { transform: scale(0.7); }
        50% { transform: scale(1); }
        100% { transform: scale(0.7); }
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

@media (max-width: 430px) {

     .hide-on-mobile {
            display: none !important;
        }
}

</style>
@endpush

@vite(['resources/css/app.css', 'resources/js/app.js'])


<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
 <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
 

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto d-flex align-items-center justify-content-center">
    @hasanyrole(['user','subuser'])
        <li class="nav-item dropdown no-arrow mx-1 d-none d-sm-inline-block" id="helpDropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"  role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 10px 15px; font-size: 1rem; font-weight: 600;">
              <i class="fas fa-question-circle mr-2 white-color" style="font-size: 1.2rem; color:#555879;"></i>
              <span class="text-gray-600">Help</span>
              <i class="fas fa-caret-down ml-1" style="font-size: 0.9rem;"></i> 
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="helpDropdown">
              @if (request()->is('dashboard*') || request()->is('ssl-check*') || request()->is('monitoring/add*'))
                  <a class="dropdown-item" id="startTourBtn">
                      <i class="fas fa-play mr-2"></i> Start Tour
  </a>
              @endif
              <a class="dropdown-item" href="{{url('/raise/tickets')}}">
                  <i class="fas fa-bug mr-2"></i> Report an Issue
              </a>
              <a class="dropdown-item" href="{{ url('/documentation') }}">
                  <i class="fas fa-info-circle mr-2"></i> For more info
              </a>
          </div>
      </li> 

       <!-- dark mode button  -->

       <button id="darkModeToggle" class="ml-2 mr-3" title="Toggle Dark Mode">
        <i id="themeIcon" class="fas fa-moon"></i>
    </button> 


<!-- Alerts -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw notification-bell" style="color: #084bbf;"></i>
        @php
            $unreadCount = auth()->user()->unreadNotifications->count();
        @endphp

        <span class="badge badge-danger badge-counter {{ $unreadCount === 0 ? 'd-none' : ''}}" id="notificationCounter">
            {{-- {{ auth()->user()->unreadNotifications->count() > 0 ? auth()->user()->unreadNotifications->count() : '' }} --}}
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
                <a class="dropdown-item d-flex align-items-start" href="{{ $notification->data['url'] ?? '#' }}">
                    <div class="mr-3">
                        {{-- <div class="icon-circle bg-{{ $notification->data['type'] === 'alert' ? 'danger' : 'primary' }}">
                            <i class="fas fa-{{ $notification->data['type'] === 'alert' ? 'exclamation-triangle' : 'info-circle' }} text-white"></i>
                        </div> --}}

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
                        <div class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                        <span class="font-weight-bold">{{ $notification->data['message'] }}</span>
                        @if(isset($notification->data['type']) && $notification->data['type'] !== 'info')
                            <span class="badge badge-{{ $notification->data['type'] === 'alert' ? 'danger' : 'warning' }} ml-2">
                                {{ ucfirst($notification->data['type']) }}
                            </span>
                        @endif
                    </div>
                </a>
            @empty
                <span class="dropdown-item text-center text-muted py-3">No notifications yet.</span>
            @endforelse
        </div>
        {{-- @if(auth()->user()->notifications->count() > 5)
            <a class="dropdown-item text-center small text-gray-500" href="{{ route('notifications.index') }}">
                Show All Notifications ({{ auth()->user()->notifications->count() }})
            </a>
        @endif --}}
    </div>
</li>

    
  @endhasanyrole
      <div class="topbar-divider d-sm-block"></div>

      <!--User profile-->
      <li class="nav-item">
          <a class="nav-link" href="{{ url('/profile') }}" role="button" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small white-color">{{ Auth::user()->name }}</span>
              <img class="img-profile rounded-circle profile"
                  src="{{ Avatar::create(auth()->user()->name)->toBase64() }}">
          </a>
      </li>

       
       <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw fa-rotate-180  text-gray-600 white-color"></i>
        </a>
        </li>

  </ul>

</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const toggleBtn = document.getElementById('darkModeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const root = document.body;

        function setTheme(isDark) {
            if (isDark) {
                root.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark');
                if (themeIcon) {
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                    themeIcon.title = "Switch to Light Mode";
                }
            } else {
                root.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
                if (themeIcon) {
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                    themeIcon.title = "Switch to Dark Mode";
                }
            }

            // for monitoring line chart
    if (window.myLineChart) {
        const isDark = document.body.classList.contains('dark-mode');
        myLineChart.options.scales.x.ticks.color = isDark ? '#e0e0e0' : '#333';
        myLineChart.options.scales.x.grid.color = isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)';
        myLineChart.options.scales.y.ticks.color = isDark ? '#e0e0e0' : '#333';
        myLineChart.options.scales.y.grid.color = isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)';

        myLineChart.options.plugins.legend.labels.color = isDark ? '#f0f0f0' : '#333';
        myLineChart.options.plugins.tooltip.backgroundColor = isDark ? '#2d2d2d' : '#fff';
        myLineChart.options.plugins.tooltip.titleColor = isDark ? '#ffffff' : '#6e707e';
        myLineChart.options.plugins.tooltip.bodyColor = isDark ? '#dddddd' : '#858796';
        myLineChart.options.plugins.tooltip.borderColor = isDark ? '#444' : '#dddfeb';

    myLineChart.update(); // ✅ Refresh chart
}
        }

        // Initial Load
        const storedTheme = localStorage.getItem('theme');
        setTheme(storedTheme === 'dark');

        // Toggle on Click
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                const isDark = !root.classList.contains('dark-mode');
                setTheme(isDark);
            });
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const bell = document.getElementById('alertsDropdown');

        if (typeof window.Echo === 'undefined') {
            console.error('❌ Echo is not defined yet');
            return;
        }

        console.log('✅ Echo is ready. Setting up listener.');

        window.Echo.channel('global.notifications')
            .listen('.new.global.notification', (e) => {
                console.log('📣 New Notification Received:', e.notification);
                updateNotificationUI(e.notification);
            });


        function updateNotificationUI(notification) {

            const counter = document.getElementById('notificationCounter');

            const currentCount = parseInt(counter.textContent) || 0;
            counter.textContent = currentCount + 1;
            counter.style.display = 'inline-block';
            counter.classList.add('pulse');
            setTimeout(() => counter.classList.remove('pulse'), 1000);


            const notificationList = document.getElementById('notificationList');
            const emptyMessage = notificationList.querySelector('.text-muted');
            if (emptyMessage) {
                notificationList.removeChild(emptyMessage);
            }

            const newNotification = document.createElement('a');
            newNotification.className = 'dropdown-item d-flex align-items-start';
            newNotification.href = notification.url || '#';

            // const typeBadge = notification.type !== 'info'
            //     ? `<span class="badge badge-${notification.type === 'alert' ? 'danger' : 'warning'} ml-2">
            //             ${notification.type.charAt(0).toUpperCase() + notification.type.slice(1)}
            //         </span>` : '';

            const iconMap = {
                alert: { color: 'danger', icon: 'exclamation-triangle', badge: 'danger' },
                announcement: { color: 'info', icon: 'bullhorn', badge: 'info' },
                update: { color: 'warning', icon: 'sync-alt', badge: 'warning' },
            };

            const type = notification.type || 'info';
            const { color, icon, badge } = iconMap[type] || { color: 'primary', icon: 'info-circle', badge: 'secondary' };

            const typeBadge = `<span class="badge badge-${badge} ml-2">
                ${type.charAt(0).toUpperCase() + type.slice(1)}
            </span>`;

            // newNotification.innerHTML = `
            //     <div class="mr-3">
            //         <div class="icon-circle bg-${notification.type === 'alert' ? 'danger' : 'primary'}">
            //             <i class="fas fa-${notification.type === 'alert' ? 'exclamation-triangle' : 'info-circle'} text-white"></i>
            //         </div>
            //     </div>
            //     <div class="flex-grow-1">
            //         <div class="small text-gray-500">${notification.time}</div>
            //         <span class="font-weight-bold">${notification.message}</span>
            //         ${typeBadge}
            //     </div>
            // `;

            newNotification.innerHTML = `
                <div class="mr-3">
                    <div class="icon-circle bg-${color}">
                        <i class="fas fa-${icon} text-white"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="small text-gray-500">${notification.time}</div>
                    <span class="font-weight-bold">${notification.message}</span>
                    ${typeBadge}
                </div>
            `;


            notificationList.insertBefore(newNotification, notificationList.firstChild);

            if (notificationList.children.length > 5) {
                notificationList.removeChild(notificationList.lastChild);
            }

            if (typeof Toast !== 'undefined') {
                Toast.fire({
                    icon: notification.type === 'alert' ? 'warning' : 'info',
                    title: 'New notification',
                    text: notification.message,
                    timer: 5000
                });
            }
        }

        if (bell) {

        bell.addEventListener('click', function () {
            fetch('/admin/notifications/mark-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                const counter = document.getElementById('notificationCounter');
                counter.textContent = '';
                counter.style.display = 'none';
            });
        });
    }

    });
</script>
@endpush