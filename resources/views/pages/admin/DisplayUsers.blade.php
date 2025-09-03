@extends('dashboard')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

<style>

    .nav-tabs{
        border-bottom: none;
    }
    .form-group {
        margin-bottom: 1rem;
        position: relative;
    }
    .form-control {
        /* display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: var(--secondary);
        background-color: var(--white);
        background-clip: padding-box;
        border: 1px solid var(--gray-light);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; */
    }
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 40px;
        cursor: pointer;
        color: var(--gray-light);
    }
    label {
        display: inline-block;
        margin-bottom: 0.5rem;
    }
    .nav-item {
        margin-right: 10px;
    }
    .nav-link.active {
        background-color: #06357f !important;
        color: var(--white) !important;
    }
    /* .dataTables_filter input {
        padding: 5px 10px;
        border: 1px solid ;
        border-radius: 4px;
        margin-bottom: 10px;
    } */
    /* .dataTables_wrapper .dataTables_filter {
        float: right;
        text-align: right;
        margin-bottom: 15px;
    } */

    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 80%;
        color: var(--danger);
    }
    .is-invalid {
        border-color: var(--danger);
    }

    .subuser-sidebar {
        position: fixed;
        top: 0;
        right: -400px; /* hidden initially */
        width: 400px;
        height: 100%;
        background: var(--white);
        /* border-left: 1px solid #ddd; */
        box-shadow: -2px 0 8px rgba(0,0,0,0.15);
        transition: right 0.3s ease;
        z-index: 1050;
        display: flex;
        flex-direction: column;
    }

    .subuser-sidebar.open {
        right: 0;
    }

    .subuser-sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: var(--light);
        border-bottom: 1px solid var(--gray-light);
    }

    .subuser-sidebar-header h5 {
        margin: 0;
        font-size: 1rem;
        color: var(--secondary);
    }

    .close-btn {
        border: none;
        background: transparent;
        font-size: 1.5rem;
        cursor: pointer;
        line-height: 1;
    }

    .subuser-sidebar-content {
        padding: 1rem;
        overflow-y: auto;
        flex: 1;
    }

    #subusersList .list-group-item {
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    #subusersList .list-group-item:hover {
        background-color:  rgba(128, 128, 128, 0.15) !important;
    }

 

    @media (max-width: 578px) {
      .dataTables_length {
        text-align: left !important;
        margin-left: 2px;
        margin-bottom: 10px;
    }
     .dataTables_filter{
            margin-left: -8px;
    }
   
}

</style>
@endpush

<!-- Right Sidebar -->
<div id="subuserSidebar" class="subuser-sidebar card">
    <div class="subuser-sidebar-header card-header">
        <h5 id="sidebarSubuser" class="white-color"></h5>
        <button class="close-btn" id="closesubuserSidebar">&times;</button>
    </div>
    <div class="subuser-sidebar-content">
        <label for="subuserSearch">Search</label>
        <input type="text" id="subuserSearch" class="form-control" placeholder="Search Subusers...">

        <ul id="subusersList" class="list-group mt-3">
            <!-- Users will be populated here -->
        </ul>
    </div>
</div>



<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">

            @php
                $defaultTab = $errors->any() ? 'users' : null;
            @endphp

            <div x-data="tabHandler({{ json_encode($defaultTab) }})" x-init="initActiveTab()">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800 white-color" 
                        x-text="activeTab === 'customers' ? 'Customers (Total: {{ $customerCount }})' : 'Users (Total: {{ $userCount }})'">
                    </h1>
                    <div x-show="activeTab === 'users'">
                        @can('add.user')
                            <button type="button" class="d-sm-inline-block btn btn-primary shadow-sm mt-4 mt-md-0" data-toggle="modal" data-target="#addUserModal">
                                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add User
                            </button>
                        @endcan
                    </div>
                </div>

                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <button class="nav-link btn-primary" :class="{ 'active': activeTab === 'customers' }" @click="activeTab = 'customers'">
                            Customers
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn-primary" :class="{ 'active': activeTab === 'users' }" @click="activeTab = 'users'">
                            Users
                        </button>
                    </li>
                </ul>

                <div x-show="activeTab === 'customers'">
                    @include('partials.customers-table', ['users' => $users])
                </div>

                <div x-show="activeTab === 'users'">
                    @include('partials.users-table', ['users' => $users])
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form id="addUserForm" action="{{ route('add.user') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Full Name*</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address*</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password*</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                {{-- <span class="fas fa-eye password-toggle" id="togglePassword"></span> --}}
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="showPasswordCheckbox">
                                    <label class="form-check-label" for="showPasswordCheckbox">Show Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">User Role*</label>
                                <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                        @if($role->name != 'user')
                                            <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };


function tabHandler(defaultTab) {
    // Check localStorage first, then fallback to defaultTab, then 'customers'
    const storedTab = localStorage.getItem('userPageItem');
    return {
        activeTab: storedTab || defaultTab || 'customers',
        customersInitialized: false,
        usersInitialized: false,
        initActiveTab() {
            // Watch for tab changes
            this.$watch('activeTab', (value) => {
                // Store the tab selection in localStorage
                localStorage.setItem('userPageItem', value);

                // Initialize tables if needed
                if (value === 'customers' && !this.customersInitialized) {
                    $('#customersTable').DataTable({
                        paging: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        responsive: true,
                        scrollX: false,
                        order: [[0, 'asc']],
                        columnDefs: [{ orderable: false, targets: -1 }]
                    });
                    this.customersInitialized = true;
                }
                if (value === 'users' && !this.usersInitialized) {
                    $('#usersTable').DataTable({
                        paging: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        responsive: true,
                        scrollX: false,
                        order: [[0, 'asc']],
                        columnDefs: [{ orderable: false, targets: -1 }]
                    });
                    this.usersInitialized = true;
                }
            });

            // Initialize the first tab if not already
            this.$nextTick(() => {
                if (this.activeTab === 'customers' && !this.customersInitialized) {
                    $('#customersTable').DataTable({
                        paging: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        responsive: true,
                        scrollX: false,
                        order: [[0, 'asc']],
                        columnDefs: [{ orderable: false, targets: -1 }]
                    });
                    this.customersInitialized = true;
                }
                if (this.activeTab === 'users' && !this.usersInitialized) {
                    $('#usersTable').DataTable({
                        paging: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        responsive: true,
                        scrollX: false,
                        order: [[0, 'asc']],
                        columnDefs: [{ orderable: false, targets: -1 }]
                    });
                    this.usersInitialized = true;
                }
            });
        }
    };
}



document.getElementById('showPasswordCheckbox').addEventListener('change', function () {
        const passwordInput = document.getElementById('password');
        passwordInput.type = this.checked ? 'text' : 'password';
    });


@if(session('success'))
$(document).ready(function() {
    toastr.success("{{ session('success') }}");
});
@endif

@if($errors->any())

    $(document).ready(function() {
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    });

@endif


</script>
@endpush
@endsection