@extends('dashboard')
@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<style>
    /* * {
        border-radius: 0 !important;
    } */
     .select-enhanced {
        padding: 0.6rem 1rem;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        transition: border-color 0.2s, box-shadow 0.2s;
        cursor: pointer;
    }
    
    .select-enhanced:hover {
        border-color: #adb5bd;
    }
    
    .select-enhanced:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        outline: none;
    }
    
    .select-enhanced option {
        padding: 8px 12px;
    }

    @media (max-width: 430px) {
     .page-content {
        margin-bottom: 240px;
}
   
}
</style>
@endpush

<div class="page-content">
    <div class="container-fluid">
        <!-- Page Title with proper margins -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="h3 mb-0 text-gray-800 white-color">Add New Permission</h4>
                    <a href="{{ route('display.permissions') }}" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2">
                        <i class="fas fa-arrow-left mr-1"></i> 
                        <span>Back</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('store.permission') }}">
                            @csrf
                            
                            <!-- Permission Name Field -->
                            <div class="mb-4">
                                <label for="name" class="form-label">Permission Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" required
                                       placeholder="e.g. create-user">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Group Name Dropdown -->
                            <div class="mb-4">
                                <label for="group_name" class="form-label fw-medium mb-2">Group Name</label>
                                <select class="form-select select-enhanced dark-bg @error('group_name') is-invalid @enderror" 
                                        id="group_name" name="group_name" required>
                                    <option value="">Select Group</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group}}">{{$group}}</option>
                                    @endforeach
                                </select>
                                @error('group_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Submit Button -->
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="fas fa-save mr-1"></i> Create Permission
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection