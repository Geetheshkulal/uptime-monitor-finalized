<!-- JS Scripts -->
<script src="{{ asset('frontend/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/demo/chart-area-demo.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>


@stack('scripts')

<script>
    function handleSidebarResize(initial = false) {
    if ($(window).width() < 768) {
        // On first load, if screen <480px → start collapsed
        if (initial && $(window).width() < 480) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $(".sidebar .collapse").collapse("hide");
        }
    } else {
        // Large screen: force expanded
        $("body").removeClass("sidebar-toggled");
        $(".sidebar").removeClass("toggled");
        $(".sidebar .collapse").collapse("show");
    }

    // Body scroll + overlay logic
    if ($(window).width() < 768) {
        if (!$(".sidebar").hasClass("toggled")) {
            // Sidebar is open → disable body scroll & show overlay
            $("body").css("overflow", "hidden");
            $(".sidebar-overlay").addClass("active");
        } else {
            // Sidebar collapsed → allow scroll & hide overlay
            $("body").css("overflow", "");
            $(".sidebar-overlay").removeClass("active");
        }
    } else {
        $("body").css("overflow", "");
        $(".sidebar-overlay").removeClass("active");
    }
}

// Run once on load with "initial=true"
$(document).ready(function () {
    // Inject overlay into DOM if not already there
    if ($(".sidebar-overlay").length === 0) {
        $("body").append('<div class="sidebar-overlay"></div>');
    }

    handleSidebarResize(true);
});

// Run on resize (but not "initial" so user toggling is preserved)
$(window).resize(function () {
    handleSidebarResize(false);
});

// Run when toggling sidebar
$("#sidebarToggle, #sidebarToggleTop").on("click", function () {
    handleSidebarResize(false);
});

// Close sidebar when clicking overlay
$(document).on("click", ".sidebar-overlay", function () {
    $("body").addClass("sidebar-toggled");
    $(".sidebar").addClass("toggled");
    $(".sidebar .collapse").collapse("hide");
    handleSidebarResize(false);
});

$(document).on('click', '.ip-address', function (e) {
    e.preventDefault();

    let ip = $(this).data('ip');

    // Update header and open sidebar
    $('#sidebarIp').text(`IP: ${ip}`);
    $('#ipSidebar').addClass('open');

    // Clear previous users
    $('#usersList').html('<li class="loading-msg text-center py-2">Loading...</li>');

    // Fetch users by IP
    $.ajax({
        url: '/activities/users-by-ip',
        method: 'GET',
        data: { ip: ip },
        success: function (response) {
            $('#usersList').empty();

            if (response.users.length === 0) {
                $("#usersList").append(
                    '<li class="no-results-msg text-center py-2">No users found</li>'
                );
            }

            response.users.forEach(user => {
                $('#usersList').append(`
                    <li class="list-group-item user-item" 
                        data-name="${user.name ?? ''}" 
                        data-email="${user.email ?? ''}"
                        data-url="/admin/display/user/${user.id}">
                        <strong>${user.name ?? 'Unnamed User'}</strong><br>
                        <small class="text-muted">E-mail: ${user.email}</small>
                    </li>
                `);
            });
        },
        error: function () {
            $('#usersList').html('<li class="list-group-item text-danger">Error loading users</li>');
        }
    });
});

// Close sidebar
$('#closeSidebar').on('click', function () {
    $('#ipSidebar').removeClass('open');
});

$(document).on("keyup", "#userSearch", function () {
    let query = $(this).val().toLowerCase();
    let anyVisible = false;

    $("#usersList li").each(function () {
        let name = $(this).data("name")?.toLowerCase() || "";
        let email = $(this).data("email")?.toLowerCase() || "";

        let match = name.includes(query) || email.includes(query);

        $(this).toggle(match);

        if (match) anyVisible = true;
    });

    // Remove previous "No users found"
    $("#usersList .no-results-msg").remove();

    // If nothing matches, show message
    if (!anyVisible) {
        $("#usersList").append(
            '<li class="no-results-msg text-center py-2">No users found</li>'
        );
    }
});


$(document).on("click", ".user-item", function () {
    let url = $(this).data("url");
    if (url) {
        window.location.href = url;
    }
});

</script>




<!-- Remove skeletons after load -->
<script>
    window.addEventListener('load', () => {
        setTimeout(() => {
            document.body.classList.remove('loading');
            // Ensure scrolling is enabled

            const skeletons = document.querySelectorAll('.skeleton');
            skeletons.forEach(el => el.classList.remove('skeleton'));
        }, 500); // Delay for loader effect
    });
</script>

<!-- Push Notification Subscription -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        async function subscribeUser() {
            if ('serviceWorker' in navigator && 'PushManager' in window) {
                try {
                    const reg = await navigator.serviceWorker.ready;
                    const sub = await reg.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: urlBase64ToUint8Array(
                            "{{ env('VAPID_PUBLIC_KEY') }}")
                    });

                    const data = {
                        endpoint: sub.endpoint,
                        keys: {
                            p256dh: btoa(String.fromCharCode.apply(null, new Uint8Array(sub.getKey(
                                'p256dh')))),
                            auth: btoa(String.fromCharCode.apply(null, new Uint8Array(sub.getKey(
                                'auth'))))
                        }
                    };

                    await fetch('/subscribe', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    });

                    console.log("Push subscription successful");
                } catch (err) {
                    console.error("Push subscription failed:", err);
                }
            } else {
                console.warn("Push not supported");
            }
        }

        function urlBase64ToUint8Array(base64String) {
            const padding = '='.repeat((4 - base64String.length % 4) % 4);
            const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
            const raw = atob(base64);
            return Uint8Array.from([...raw].map(c => c.charCodeAt(0)));
        }

        window.subscribeUser = subscribeUser;
        subscribeUser();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const toggleBtn = document.getElementById('sidebarToggleTop');
        const sidebar = document.getElementById('accordionSidebar');

        // Track outside click
        document.addEventListener('click', function(e) {
            const isVisible = !sidebar.classList.contains('toggled');
            const clickedOutsideSidebar = !sidebar.contains(e.target);
            const clickedOutsideToggle = !toggleBtn.contains(e.target);

            if (window.innerWidth < 768 && isVisible && clickedOutsideSidebar && clickedOutsideToggle) {
                toggleBtn.click();
            }
        });

        // Prevent the toggle click from closing immediately
        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
        });

    });


    document.addEventListener('DOMContentLoaded', function() {

        const toggleBtn = document.getElementById('darkModeToggle');
        const themeIcon = document.getElementById('themeIcon');
        // const root = document.body;
        const root = document.documentElement;

      

        function setTheme(isDark) {
            if (isDark) {
                root.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark');
                if (themeIcon) {
                    themeIcon.classList.remove('fa-sun');
                    themeIcon.classList.add('fa-moon');
                    // themeIcon.title = "Switch to Light Mode";
                    // updateTooltip('Light Mode');
                }
            } else {
                root.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
                if (themeIcon) {
                    themeIcon.classList.remove('fa-moon');
                    themeIcon.classList.add('fa-sun');
                    // themeIcon.title = "Switch to Dark Mode";
                    // updateTooltip('Dark Mode');
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
    document.addEventListener('DOMContentLoaded', function() {

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
            const notificationList = document.getElementById('notificationList');

            const currentCount = parseInt(counter.textContent) || 0;
            counter.textContent = currentCount + 1;

            counter.classList.remove('d-none');
            counter.style.display = 'inline-block';
            counter.classList.add('pulse');
            setTimeout(() => counter.classList.remove('pulse'), 1000);

            const emptyMessage = notificationList.querySelector('.text-muted');
            if (emptyMessage) {
                notificationList.removeChild(emptyMessage);
            }

            const newNotification = document.createElement('a');
            newNotification.className = 'dropdown-item d-flex align-items-start';
            newNotification.href = notification.url || '#';

            const iconMap = {
                alert: {
                    color: 'danger',
                    icon: 'exclamation-triangle',
                    badge: 'danger'
                },
                announcement: {
                    color: 'info',
                    icon: 'bullhorn',
                    badge: 'info'
                },
                update: {
                    color: 'warning',
                    icon: 'sync-alt',
                    badge: 'warning'
                },
            };

            const type = notification.type || 'info';
            const {
                color,
                icon,
                badge
            } = iconMap[type] || {
                color: 'primary',
                icon: 'info-circle',
                badge: 'secondary'
            };

            const typeBadge = `<span class="badge badge-${badge} ml-2">
                                    ${type.charAt(0).toUpperCase() + type.slice(1)}
                                </span>`;

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

            bell.addEventListener('click', function() {
                fetch('/admin/notifications/mark-read', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const countdownEl = document.getElementById('trial-hours-left');
        if (!countdownEl) return;

        const now = new Date();
        const midnight = new Date();
        midnight.setHours(24, 0, 0, 0); // Today 

        const diffMs = midnight - now;
        if (diffMs > 0) {
            const hoursLeft = Math.floor(diffMs / (1000 * 60 * 60));
            countdownEl.textContent = `Trial ends in ${hoursLeft} hour${hoursLeft !== 1 ? 's' : ''}`;
        } else {
            // Hide banner if it's already past midnight
            const trialNotice = countdownEl.closest('.trial-notice');
            if (trialNotice) trialNotice.remove();
        }
    });
</script>
