@extends('dashboard')
@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

<div class="page-content">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 white-color">Edit Users</h1>
        </div>

        <!-- Edit Form -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('update.user', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                        value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            @foreach($roles as $role)
                                                @if($role->name != 'user')
                                                    <option value="{{ $role->id }}" 
                                                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Update User
                                </button>
                                <a href="{{ route('display.users') }}" class="btn btn-secondary waves-effect ms-2">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
    
    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
</script>
@endpush

@endsection