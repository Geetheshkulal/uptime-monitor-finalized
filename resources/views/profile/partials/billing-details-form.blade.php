

@push('styles')
<style>
    
select.no-arrow {
  appearance: none; 
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: none !important; 

  border-color: #6b7280;
}

    @media screen and (max-width: 430px) {
        .profile-update{
            width: 100% !important;
        }
    }
    </style>
@endpush


<section>

    <h2 class="text-lg font-medium text-gray-900 white-color">Billing Information</h2>
    <p class="mt-1 text-sm text-gray-600 white-color">Update your billing address and location details.</p>

    <form method="post" action="{{ route('update.billing.info') }}" class="mt-4  profile-update">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-md-5 mb-3">
                <label for="address" class="form-label">Address Line 1<sup class="text-danger">*</sup></label>
                <input id="address_1" name="address_1" type="text" class="form-control form-control-sm" value="{{ old('address_!', $user->address_1) }}">
                <x-input-error :messages="$errors->get('address_1')" class="text-danger small" />
            </div>

            <div class="col-md-5 mb-3">
                <label for="address" class="form-label">Address Line 2</label>
                <input id="address_2" name="address_2" type="text" class="form-control form-control-sm" value="{{ old('address_2', $user->address_2) }}">
                <x-input-error :messages="$errors->get('address_2')" class="text-danger small" />
            </div>
            
            <div class="col-md-3 mb-3">
                <label class="form-label" for="pincode">Pincode <sup class="text-danger">*</sup></label>
                <input id="pincode" name="pincode" type="text" class="form-control form-control-sm" placeholder="Pincode" value="{{ old('pincode', $user->pincode) }}">
                <x-input-error :messages="$errors->get('pincode')" class="text-danger small" />
            </div>

            @php
                $selectedPlace = old('place', $user->place);
                $selectedPincode = old('pincode', $user->pincode);
            @endphp
            
            <div class="col-md-3 mb-3">
                <label class="form-label" for="place">Place <sup class="text-danger">*</sup></label>
                <div id="placeWrapper">
                    <select class="form-control no-arrow" id="place" name="place" required>
                        @if ($selectedPlace)
                            <option value="{{ $selectedPlace }}" selected hidden>{{ $selectedPlace }}</option>
                        @else
                            <option value="" disabled selected>Select Place</option>
                        @endif
                    </select>
                    <div class="invalid-feedback">Please select or enter a valid place (letters only)</div>
                </div>
                
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label" for="district">District <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="district" name="district" placeholder="District" value="{{ old('district', $user->district) }}" readonly>
                <x-input-error :messages="$errors->get('district')" class="text-danger small" />
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label" for="state">State <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ old('state', $user->state) }}" readonly>
                {{-- <div class="invalid-feedback">Please enter state</div> --}}
                <x-input-error :messages="$errors->get('state')" class="text-danger small" />
            </div>
            
            <div class="col-md-3 mb-3">
                <label for="country" class="form-label">Country <sup class="text-danger">*</sup></label>
                <input id="country" name="country" type="text" class="form-control form-control-sm" placeholder="Country" value="{{ old('country', $user->country) }}" readonly>
                <x-input-error :messages="$errors->get('country')" class="text-danger small" />
            </div>

            <div class="col-md-4 mb-3">
                <label for="gstin" class="form-label">GSTIN </label>
                <input id="gstin" name="gstin" type="text" class="form-control form-control-sm" value="{{ old('gstin', $user->gstin) }}" placeholder="22xxxxxxxx1Z5">
                {{-- <x-input-error :messages="$errors->get('gstin')" class="text-danger small" /> --}}
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-sm">Save Billing Info</button>
    </form>

</section>



@push('scripts')
<script>
    function debounce(func, delay = 500) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    function initPincodeScript() {
        const pincodeInput = document.getElementById('pincode');
        if (!pincodeInput) return;

        pincodeInput.addEventListener('input', debounce(handlePincodeLookup, 600));

        function handlePincodeLookup() {
            const pincode = pincodeInput.value.trim();
            if (pincode.length !== 6) return;

            fetch(`https://api.postalpincode.in/pincode/${pincode}`)
                .then(response => response.json())
                .then(data => {
                    const placeWrapper = document.getElementById('placeWrapper');
                    placeWrapper.innerHTML = `
                        <select class="form-control" id="place" name="place" required>
                            <option value="" disabled selected>Select Place</option>
                        </select>
                        <div class="invalid-feedback">Please select or enter a valid place</div>
                    `;

                    const placeSelect = document.getElementById('place');

                    if (data[0].Status === "Success") {
                        const postOffices = data[0].PostOffice;

                        if (Array.isArray(postOffices) && postOffices.length > 0) {
                            postOffices.forEach(po => {
                                const option = document.createElement('option');
                                option.value = po.Name;
                                option.textContent = po.Name;
                                placeSelect.appendChild(option);
                            });

                            const otherOption = document.createElement('option');
                            otherOption.value = "Others";
                            otherOption.textContent = "Others";
                            placeSelect.appendChild(otherOption);

                            document.getElementById('district').value = postOffices[0].District;
                            document.getElementById('state').value = postOffices[0].State;
                            document.getElementById('country').value = postOffices[0].Country;

                            placeSelect.addEventListener('change', function () {
                                if (this.value === "Others") {
                                    placeWrapper.innerHTML = `
                                        <input type="text" class="form-control" id="place" name="place" placeholder="Enter place" required>
                                        <div class="invalid-feedback">Please select or enter a valid place (letters only)</div>
                                    `;
                                    setTimeout(() => {
                                        const placeInput = document.getElementById('place');
                                        placeInput.addEventListener('input', validatePlaceName);
                                        placeInput.addEventListener('blur', validatePlaceName);
                                    }, 50);
                                }
                            });
                        } else {
                            toastr.error("No places found for this pincode.");
                        }
                    } else {
                        toastr.error("Invalid Pincode or no data found.");
                    }
                })
                .catch(error => {
                    console.error("Error fetching pincode info:", error);
                });
        }
    }
</script>


<script>
   document.addEventListener("DOMContentLoaded", function () {
    const pincodeInput = document.getElementById('pincode');
    const originalPincode = @json($selectedPincode);
    const savedPlace = @json($selectedPlace);

    function loadPlaces(pincode, preselect = null) {
        fetch(`https://api.postalpincode.in/pincode/${pincode}`)
            .then(response => response.json())
            .then(data => {
                if (data[0].Status === "Success") {
                    const postOffices = data[0].PostOffice;
                    const placeWrapper = document.getElementById('placeWrapper');

                    placeWrapper.innerHTML = `
                        <select class="form-control" id="place" name="place" required>
                            <option value="" disabled selected>Select Place</option>
                        </select>
                        <div class="invalid-feedback">Please select or enter a valid place</div>
                    `;

                    const placeSelect = document.getElementById('place');

                    postOffices.forEach(po => {
                        const option = document.createElement('option');
                        option.value = po.Name;
                        option.textContent = po.Name;
                        if (po.Name === preselect) {
                            option.selected = true;
                        }
                        placeSelect.appendChild(option);
                    });

                    const otherOption = document.createElement('option');
                    otherOption.value = "Others";
                    otherOption.textContent = "Others";
                    if (preselect === "Others") otherOption.selected = true;
                    placeSelect.appendChild(otherOption);

                    // Auto-fill other fields
                    document.getElementById('district').value = postOffices[0].District;
                    document.getElementById('state').value = postOffices[0].State;
                    document.getElementById('country').value = "India";

                    // Handle Others
                    placeSelect.addEventListener('change', function () {
                        if (this.value === "Others") {
                            placeWrapper.innerHTML = `
                                <input type="text" class="form-control" id="place" name="place" placeholder="Enter place" required value="Others">
                                <div class="invalid-feedback">Please select or enter a valid place (letters only)</div>
                            `;
                        }
                    });
                }
            });
    }

    // Detect when pincode changes
    pincodeInput.addEventListener('blur', function () {

        const placeSelect = document.getElementById('place');
        placeSelect.classList.remove('no-arrow');
        placeSelect.style.pointerEvents = 'auto';

        const newPin = this.value.trim();
        if (newPin.length === 6 && newPin !== originalPincode) {
            loadPlaces(newPin);
        }
    });

    // If there's a saved pincode but no change, show just the saved option (already rendered from Blade)
});

    </script>
    
    
@endpush

