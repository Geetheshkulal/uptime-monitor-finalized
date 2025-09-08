@extends('dashboard')
@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<style>
    * {
        border-radius: 3px !important;
    }

    html.dark-mode .card-header {
        border: none;
    }

    .form-check-input:focus {
        box-shadow: none !important;
        outline: none !important;
    }

    .nav-tabs {
        border-bottom: none;
    }

    .nav-tabs .nav-link.active {
        background-color: var(--primary);
        color: var(--white);
        border: none;
    }

    html.dark-mode .nav-tabs .nav-link:hover {
        border: 1px solid var(--primary) !important;
    }

    @media (max-width: 578px) {
        .dataTables_length {
            text-align: left !important;
            margin-left: 2px;
            margin-bottom: 10px;
        }

        .dataTables_filter {
            margin-left: -11px;
        }
    }
</style>
@endpush

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 white-color">User Details</h1>
        <div>
            <a href="{{ route('display.users') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to Users
            </a>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="userDetailsTabs" role="tablist" style="gap: 5px;">
        <li class="nav-item">
            <button class="nav-link active" id="user-info-tab" data-toggle="tab" href="#user-info" type="button"
                role="tab" aria-controls="user-info" aria-selected="true">
                User Information
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="user-monitors-tab" data-toggle="tab" href="#user-monitors" type="button"
                role="tab" aria-controls="user-monitors" aria-selected="false">
                User Monitors
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="ssl-checks-tab" data-toggle="tab" href="#ssl-checks" type="button" role="tab"
                aria-controls="ssl-checks" aria-selected="false">
                SSL Checks
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="monitoringTabsContent">
        <div class="tab-pane fade show active" id="user-info" role="tabpanel" aria-labelledby="user-info-tab">
            @include('pages.admin.ViewUserInformation')
        </div>

        @can('see.monitors')
            @if($user->hasAnyRole(['user','subuser']))
                <div class="tab-pane fade" id="user-monitors" role="tabpanel" aria-labelledby="user-monitors-tab">
                    @include('pages.admin.ViewUserMonitor')
                </div>
            @endif
        @endcan

        <div class="tab-pane fade" id="ssl-checks" role="tabpanel" aria-labelledby="ssl-checks-tab">
            @include('pages.admin.ViewUserSsl')
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
    
    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif

    // Initialize tabs and restore previously selected tab
    document.addEventListener('DOMContentLoaded', function () {
        const activeTab = localStorage.getItem('userDetailsTab') || 'user-info-tab';
        const defaultTabButton = document.getElementById(activeTab);
        if (defaultTabButton) {
            defaultTabButton.click();
        }

        const tabButtons = document.querySelectorAll('#userDetailsTabs button[data-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                localStorage.setItem('userDetailsTab', this.id);
            });
        });
    });
</script>
@endpush

@endsection
