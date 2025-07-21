@extends('dashboard')
@section('content')
<head>
    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
    <style>
        /* * {
    border-radius: 0 !important;
    } */

    html, body {
    height: 100%;
    margin: 0;
}

#content-wrapper {
    min-height: 100vh; 
    display: flex;
    flex-direction: column;
    
}

#content {
    flex: 1; 
}

     .form-group {
            margin-bottom: 1rem;
            position: relative;
        }
        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
      

    .password-toggle {
    position: absolute;
    top: 45px;
    right: 16px; 
    transform: translateX(-80%);
    cursor: pointer;
    color: #6c757d;
    z-index: 2;
}
        label {
            display: inline-block;
            margin-bottom: 0.5rem;
        }
    #content {
    flex: 1;
}
@media (max-width: 430px) {

.dataTables_length {
   text-align: left !important;
   margin-left: 2px;
   margin-bottom: 10px;
}
.dataTables_filter{
    margin-top: 5px;
    margin-left: -9px;
}

}


.blur-content {
    filter: blur(3px);
    opacity: 0.8;
    pointer-events: none; 
    user-select: none; 
}


.premium-modal {
    position: fixed;
    top: 80%;
    left: 55%;
    transform: translate(-50%, -50%);
    z-index: 1050;
    width: 400px;
    max-width: 90%;
}

.modal-content {
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}


    
    .text-gold {
        color: #ffc107;
    }
    
    .btn-gold {
        background-color: #ffc107;
        color: #000;
    }



</style>
@endpush
</head>


@if(session('showPremiumModal'))
<div id="content-wrapper" class="d-flex flex-column blur-content">
@else
<div id="content-wrapper" class="d-flex flex-column">
@endif
    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 white-color">Users (Total: {{ $subUsers->count()}})</h1>
                    <button type="button" class="d-sm-inline-block btn btn-primary shadow-sm mt-4 mt-md-0" data-toggle="modal" data-target="#addUserModal">
                        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add User
                    </button>
            </div>

            <!-- Users Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap" id="usersTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('edit.sub.user.permissions', $user->id) }}" class="ml-2" title="View">
                                                <i class="fas fa-eye" style="color: #2c4ee5; cursor: pointer;"></i>
                                            </a>
                                        </div>
                                        <div class="btn-group" role="group">

                                            <a href="#" data-toggle="modal" data-target="#deleteSubUserModal{{ $user->id }}" class="ml-2">
                                                <i class="fas fa-trash" style="color: #e74a3b; cursor: pointer;"></i></a>
                                        </div>
                                        
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No users found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>


@if(session('showPremiumModal'))
    <!-- Premium Feature Modal (outside content wrapper) -->
    <div class="modal premium-modal show" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gold">Premium Feature</h5>
                </div>
                <div class="modal-body">
                    <p>SSL Check is a premium feature. Upgrade your plan to access this tool.</p>
                    <div class="text-center mb-3">
                        <i class="fas fa-lock fa-3x text-gold"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Close</button>
                    <a href="{{ route('premium.page') }}" class="btn btn-gold">
                        <i class="fas fa-crown"></i> Upgrade Plan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif




<!-- Delete Coupon Modal -->
 
@foreach ($subUsers as $user)
<div class="modal fade" id="deleteSubUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteSubUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="POST" action="{{ route('delete.sub.user', $user->id) }}">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSubUserModalLabel{{ $user->id }}">Delete Sub User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    
            <div class="modal-body">
                <p>Are you sure you want to delete Sub User</p>
                <p>This action cannot be undone.</p>
            </div>
    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete Sub User</button>
            </div>
        </form>
    </div>
</div>
@endforeach


 <!-- Add User Modal -->
 <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New Sub-User</h5>
                <button type="button" class="close white-color" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addUserForm" action="{{ route('add.sub.user') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Full Name*</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="eg: John">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address*</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="eg: John@gmail.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone*</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="eg: 97xxxxxx99">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

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
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Sub-User</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "paging": true, 
            "searching": true,
            "ordering": true,
            "info": false,
            "responsive": true,
            "scrollX": false,
            "order": [[0, "asc"]],
            "columnDefs": [
                { "orderable": false, "targets": [3] } // Disable sorting for action column
            ]
        });
    });

  
    document.getElementById('showPasswordCheckbox').addEventListener('change', function () {
        const passwordInput = document.getElementById('password');
        passwordInput.type = this.checked ? 'text' : 'password';
    });


</script>

@if(session('success'))
<script>
    toastr.success("{{ session('success') }}");
</script>
@endif

@if ($errors->any())
    <script>
        $(document).ready(function () {
            $('#addUserModal').modal('show');
        });
    </script>
@endif

@endpush

@endsection