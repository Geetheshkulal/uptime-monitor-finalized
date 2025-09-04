@extends('dashboard')
@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>
   
    .feature-item {
        padding: 10px;
        border-radius: 5px;
    }
    .card{
        width: 80%
    }

    a:hover{
        text-decoration: none !important;
    }
    @media (max-width: 578px) {
    .card{
        width: 100%
    }
    .back-button{
        margin-left: auto;
    } 
    .feature-item{
        gap: 14px;
    }
   
}

.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: var(--gray-light);
    transition: all 0.3s ease;
    border-radius: 34px !important;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: var(--white);
    transition: all 0.3s ease;
    border-radius: 50% !important;
}

input:checked + .slider {
    background: var(--primary);
}

input:checked + .slider:before {
    transform: translateX(26px);
}
</style>
    
@endpush

<div id="content-wrapper" class="d-flex flex-column">
<div class="page-content">
<div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-2 text-gray-800 white-color order-1 order-sm-0">Edit Plan Features: {{ $subscription->name }}</h1>
            <a href="{{ route('billing') }}" class="btn btn-secondary order-0 order-sm-1 mb-2 md-sm-0 back-button">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    
        <form method="POST" action="{{ route('admin.features.update', $subscription->id) }}">
            @csrf
            @method('PUT')
    
            <!-- Other form fields (name, amount, etc.) -->
    
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Features</h3>
                </div>
                <div class="card-body">
                    <div id="feature-list">
                        @foreach($features as $index => $feature)
                            <div class="feature-item mb-3 row">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" 
                                           name="features[{{ $index }}][name]" 
                                           value="{{ $feature['name'] }}" 
                                           placeholder="Feature name" required>
                                </div>
                                {{-- <div class="col-md-3 col-12">
                                    <select class="form-control" name="features[{{ $index }}][available]">
                                        <option value="1" {{ $feature['available'] ? 'selected' : '' }}>Available</option>
                                        <option value="0" {{ !$feature['available'] ? 'selected' : '' }}>Not Available</option>
                                    </select>
                                </div> --}}

                                <div class="col-md-3 col-12 d-flex justify-content-between align-items-center">
                                <input type="hidden" name="features[{{ $index }}][available]" value="0">
                                <label class="switch">
                                    <input type="checkbox" 
                                        name="features[{{ $index }}][available]" 
                                        value="1" 
                                        {{ $feature['available'] ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                                <div class="">
                                    <button type="button" class="btn btn-danger" onclick="removeFeature(this)">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                    <button type="button" class="btn btn-secondary mt-3" onclick="addFeature()">
                        <i class="fas fa-plus"></i> Add New Feature
                    </button>
                </div>
            </div>
    
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
</div>
</div>
</div>


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    function toggleAvailable(button) {
        const hiddenInput = button.previousElementSibling;
        if (hiddenInput.value == "1") {
            hiddenInput.value = "0";
            button.textContent = "Not Available";
            button.classList.remove("btn-success");
            button.classList.add("btn-secondary");
        } else {
            hiddenInput.value = "1";
            button.textContent = "Available";
            button.classList.remove("btn-secondary");
            button.classList.add("btn-success");
        }
    }
</script>
    
<script>
    toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

@if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
@endif

@if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
@endif

    let featureIndex = {{ count($features) }};

    function addFeature() {
        const featureList = document.getElementById('feature-list');
        const newFeature = document.createElement('div');
        newFeature.className = 'feature-item mb-3 row';
        newFeature.innerHTML = `
            <div class="col-md-5">
                <input type="text" class="form-control" 
                       name="features[${featureIndex}][name]" 
                       placeholder="Feature name" required>
            </div>
            <div class="col-md-3 col-12 d-flex justify-content-between align-items-center">
                                <input type="hidden" name="features[${featureIndex}][available]" value="0">
                                <label class="switch">
                                    <input type="checkbox" 
                                        name="features[${featureIndex}][available]"
                                        value="1">
                                    <span class="slider"></span>
                                </label>
                                <div class="">
                                    <button type="button" class="btn btn-danger" onclick="removeFeature(this)">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </div>
            </div>
        `;
        featureList.appendChild(newFeature);
        featureIndex++;
    }

    function removeFeature(button) {
        const featureItem = button.closest('.feature-item');
        featureItem.remove();
        // Reindex remaining features if needed
    }
</script>

@endpush
@endsection