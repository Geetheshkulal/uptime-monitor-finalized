@extends('dashboard')
@section('content')

    <head>
        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/introjs.min.css"/>

    </head>
  <style>

    /* ========== INTROJS TOUR ========== */
        .introjs-tooltip {
            background-color: white;
            color: rgb(51, 48, 48);
            font-family: 'Poppins', sans-serif;
            border-radius: 0.35rem;
            /* box-shadow: 0 0.5rem 1.5rem rgba(7, 18, 144, 0.2); */
            box-shadow: 0px 0px 6px 4px rgba(28, 61, 245, 0.2);   
        }

        .introjs-tooltip-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .introjs-button {
            background-color: var(--primary);
            border-radius: 0.25rem;
            font-weight: 600;
            color: white;
            cursor: pointer;
            text-shadow: none;
        }

        .introjs-button:hover {
            background-color: #2e59d9;
            color: white;
        } 
        .introjs-overlay
         {
        pointer-events: none; 
        }

        .introjs-helperLayer {
        pointer-events: none;
        z-index: 1001;
        }
        .btn {
            border-radius: 0.35rem;
            font-weight: 600;
            padding: 0.5rem 1.25rem;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }
        .container-fluid{
            overflow: auto;
            margin-left: -19px;
        }
        .nav-tabs{
            border-bottom: none;
        }
.nav-tabs .nav-link{
    margin: 5px;
}

@media (max-width: 576px) {
    .introjs-tooltip,
    .introjs-overlay,
    .introjs-floating,
    .introjs-helperLayer {
    display: none !important;
        
    }
}
 </style>

<div class="container-fluid">
    <div class="row mb-4 px-3 px-lg-4">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h1 class="h3 mb-0 ml-lg-3">Add Monitoring</h1>
                <a href="{{ route('monitoring.dashboard') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

    {{-- Dropdown for Monitor Types --}}
    {{-- <div class="dropdown mb-4 mx-3 mx-lg-5">
        <button class="btn btn-primary dropdown-toggle MonitorTypes" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            HTTP Monitoring
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item fs-6" href="#" onclick="updateDropdown('HTTP Monitoring', 'http')">HTTP
                Monitoring</a>
            <a class="dropdown-item fs-6" href="#" onclick="updateDropdown('Ping Monitoring', 'ping')">Ping
                Monitoring</a>
            <a class="dropdown-item fs-6" href="#" onclick="updateDropdown('Port Monitoring', 'port')">Port
                Monitoring</a>
            <a class="dropdown-item fs-6" href="#" onclick="updateDropdown('DNS Monitoring', 'dns')">DNS
                Monitoring</a>
        </div>
    </div> --}}

    <!-- Tabs Navigation -->
<ul class="nav nav-tabs mb-4 mx-3 mx-lg-5" id="monitoringTabs" role="tablist">
    <li class="nav-item">
        <button class="nav-link active HttpMonitoring" id="http-tab" data-toggle="tab" href="#http" type="button" role="tab" aria-controls="http" aria-selected="true">
            HTTP Monitoring
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link PingMonitoring" id="ping-tab" data-toggle="tab" href="#ping" type="button" role="tab" aria-controls="ping" aria-selected="false">
            Ping Monitoring
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link PortMonitoring" id="port-tab" data-toggle="tab" href="#port" type="button" role="tab" aria-controls="port" aria-selected="false">
            Port Monitoring
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link DnsMonitoring" id="dns-tab" data-toggle="tab" href="#dns" type="button" role="tab" aria-controls="dns" aria-selected="false">
            DNS Monitoring
        </button>
    </li>
</ul>

    <!-- Tab Content -->
<!-- Tab Content -->
<div class="tab-content" id="monitoringTabsContent">
    <div class="tab-pane fade show active" id="http" role="tabpanel" aria-labelledby="http-tab">
        @include('monitoring.http')
    </div>
    <div class="tab-pane fade" id="ping" role="tabpanel" aria-labelledby="ping-tab">
        @include('monitoring.ping')
    </div>
    <div class="tab-pane fade" id="port" role="tabpanel" aria-labelledby="port-tab">
        @include('monitoring.port')
    </div>
    <div class="tab-pane fade" id="dns" role="tabpanel" aria-labelledby="dns-tab">
        @include('monitoring.dns')
    </div>
</div>


@push('scripts')

 <!-- jQuery and Toastr scripts -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>

 <script>
    // Validation helper functions
    function isValidUrl(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }

    function isValidDomain(string) {
        const domainPattern = /^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/i;
        return domainPattern.test(string);
    }

    function isValidEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }

    function showError(inputElement, message) {
        const existingError = inputElement.parentNode.querySelector('.invalid-feedback');
        if (existingError) {
            existingError.remove();
        }

        inputElement.classList.add('is-invalid');

        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.innerText = message;
        inputElement.parentNode.appendChild(errorDiv);
    }

    function clearError(inputElement) {
        inputElement.classList.remove('is-invalid');
        const existingError = inputElement.parentNode.querySelector('.invalid-feedback');
        if (existingError) {
            existingError.remove();
        }
    }

    // The showForm function with improved validation
    function showForm(type) {
        const formContainer = document.getElementById('formContainer');
        formContainer.innerHTML = `
            <h4 class="card-title">${forms[type].title}</h4>
            <form id="monitoringForm" method="POST" action="${forms[type].action}">
                @csrf
                <input type="hidden" name="form_type" value="${type}"> <!-- Add this hidden input -->
                <input type="hidden" id="selectedType" name="selectedType" value="${type}"> <!-- Hidden input -->
                ${forms[type].fields}
            </form>
        `;

        const form = document.getElementById('monitoringForm');
        form.addEventListener('submit', function(event) {
            let isValid = true;

            // URL/Domain validation
            const urlField = document.getElementById('url') || document.getElementById('domain');
            if (urlField) {
                const fieldValue = urlField.value.trim();
                if (fieldValue !== '') {
                    if (type === 'http') {
                        if (!isValidUrl(fieldValue)) {
                            event.preventDefault();
                            showError(urlField, 'Please enter a valid URL (e.g., https://example.com)');
                            isValid = false;
                        } else {
                            clearError(urlField);
                        }
                    } else {
                        if (!isValidUrl(fieldValue) && !isValidDomain(fieldValue)) {
                            event.preventDefault();
                            showError(urlField, 'Please enter a valid URL or domain name');
                            isValid = false;
                        } else {
                            clearError(urlField);
                        }
                    }
                }
            }

            // Retries validation (1-5)
            const retriesField = document.getElementById('retries');
            if (retriesField) {
                const retriesValue = parseInt(retriesField.value);
                if (isNaN(retriesValue) || retriesValue < 1 || retriesValue > 5) {
                    event.preventDefault();
                    showError(retriesField, 'Retries must be between 1 and 5');
                    isValid = false;
                } else {
                    clearError(retriesField);
                }
            }

            // Interval validation (1-1440)
            const intervalField = document.getElementById('interval');
            if (intervalField) {
                const intervalValue = parseInt(intervalField.value);
                if (isNaN(intervalValue) || intervalValue < 1 || intervalValue > 1440) {
                    event.preventDefault();
                    showError(intervalField, 'Interval must be between 1 and 1440 minutes');
                    isValid = false;
                } else {
                    clearError(intervalField);
                }
            }

            // Email validation
            const emailField = document.getElementById('email');
            if (emailField) {
                const emailValue = emailField.value.trim();
                if (!isValidEmail(emailValue)) {
                    event.preventDefault();
                    showError(emailField, 'Please enter a valid email address');
                    isValid = false;
                } else {
                    clearError(emailField);
                }
            }

            return isValid;
        });

        // URL/Domain field validation
        const urlField = document.getElementById('url') || document.getElementById('domain');
        if (urlField) {
            urlField.addEventListener('blur', function() {
                const fieldValue = urlField.value.trim();
                if (fieldValue === '') {
                    clearError(urlField);
                    return;
                }

                if (type === 'http') {
                    if (!isValidUrl(fieldValue)) {
                        showError(urlField, 'Please enter a valid URL (e.g., https://example.com)');
                    } else {
                        clearError(urlField);
                    }
                } else {
                    if (!isValidUrl(fieldValue) && !isValidDomain(fieldValue)) {
                        showError(urlField, 'Please enter a valid URL or domain name');
                    } else {
                        clearError(urlField);
                    }
                }
            });

            urlField.addEventListener('input', function() {
                const fieldValue = urlField.value.trim();
                if (fieldValue === '') {
                    clearError(urlField);
                }
            });
        }

        // Retries field validation
        const retriesField = document.getElementById('retries');
        if (retriesField) {
            retriesField.addEventListener('blur', function() {
                const value = parseInt(this.value);
                if (isNaN(value) || value < 1 || value > 5) {
                    showError(this, 'Retries must be between 1 and 5');
                } else {
                    clearError(this);
                }
            });

            retriesField.addEventListener('input', function() {
                if (this.value === '') {
                    clearError(this);
                }
            });
        }

        // Interval field validation
        const intervalField = document.getElementById('interval');
        if (intervalField) {
            intervalField.addEventListener('blur', function() {
                const value = parseInt(this.value);
                if (isNaN(value) || value < 1 || value > 1440) {
                    showError(this, 'Interval must be between 1 and 1440 minutes');
                } else {
                    clearError(this);
                }
            });

            intervalField.addEventListener('input', function() {
                if (this.value === '') {
                    clearError(this);
                }
            });
        }

        // Email field validation
        const emailField = document.getElementById('email');
        if (emailField) {
            emailField.addEventListener('blur', function() {
                const emailValue = this.value.trim();
                if (!isValidEmail(emailValue)) {
                    showError(this, 'Please enter a valid email address');
                } else {
                    clearError(this);
                }
            });

            emailField.addEventListener('input', function() {
                if (this.value === '') {
                    clearError(this);
                }
            });
        }
    }

    // Initialize form on page load
    // document.addEventListener('DOMContentLoaded', function() {
    //     const selectedType = "{{ old('selectedType', 'http') }}"; 
    //     document.getElementById("dropdownMenuButton").innerText = forms[selectedType].title;
    //     showForm(selectedType);
    // });
</script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

         // Initialize tabs and show the previously selected tab if there was a validation error
    document.addEventListener('DOMContentLoaded', function() {
        const activeTab = localStorage.getItem('activeMonitoringTab') || 'http-tab';
        document.getElementById(activeTab).click();
        
        // Store the active tab when changed
        const tabButtons = document.querySelectorAll('#monitoringTabs button[data-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                localStorage.setItem('activeMonitoringTab', this.id);
            });
        });
    });

    </script>

<script>
    // Initialize tour(tool tip)
document.addEventListener("DOMContentLoaded", function () {
    
    if(window.innerWidth > 576){

    introJs().setOptions({
        disableInteraction: false,
        steps: [
                {
                element: document.querySelector('.HttpMonitoring'),
                intro: 'Monitor the availability and response status of your websites or web applications using HTTP checks.',
                position: 'right'
            },
            {
                element: document.querySelector('.PingMonitoring'),
                intro: 'Use ping to monitor server or device reachability and network latency.',
                position: 'right'
            },
            {
                element: document.querySelector('.PortMonitoring'),
                intro: 'Ensure specific ports (e.g., 22, 80, 443) on your server are open and responsive.',
                position: 'right'
            },
            {
                element: document.querySelector('.DnsMonitoring'),
                intro: 'Monitor DNS resolution to ensure your domains are resolving correctly to IP addresses.',
                position: 'right'
            }
            ],
        dontShowAgain: true,
        nextLabel: 'Next',
        prevLabel: 'Back',
        doneLabel: 'Finish'
    }).start();
}
});

</script>

<script>
$(document).ready(function() {
   $('#startTourBtn').click(function() {
       introJs().setOptions({
           steps: [
            {
            element: document.querySelector('.HttpMonitoring'),
            intro: 'Monitor the availability and response status of your websites or web applications using HTTP checks.',
            position: 'right'
        },
        {
            element: document.querySelector('.PingMonitoring'),
            intro: 'Use ping to monitor server or device reachability and network latency.',
            position: 'right'
        },
        {
            element: document.querySelector('.PortMonitoring'),
            intro: 'Ensure specific ports (e.g., 22, 80, 443) on your server are open and responsive.',
            position: 'right'
        },
        {
            element: document.querySelector('.DnsMonitoring'),
            intro: 'Monitor DNS resolution to ensure your domains are resolving correctly to IP addresses.',
            position: 'right'
        }
           ],
           nextLabel: 'Next',
           prevLabel: 'Back',
           doneLabel: 'Finish'
       }).start();
   });
});
</script>
@endpush

@endsection
