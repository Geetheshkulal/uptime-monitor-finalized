
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<style>
    * {
        border-radius: 3px !important;
    }

    html.dark-mode .card-header{
        border: none;
    }

    .form-check-input:focus {
    box-shadow: none !important;
    outline: none !important;
}
.nav-tabs{
            border-bottom: none;
        }

@media (max-width: 578px) {
    .dataTables_length {
        text-align: left !important;
        margin-left: 2px;
        margin-bottom: 10px;
    }
     .dataTables_filter{
            margin-left: -11px;
    }
   
}

</style>
@endpush

    <!-- User Details Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                            </tr>
                            @if($user->hasRole('user'))
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge badge-{{ $user->status === 'active' ? 'success' : ($user->status === 'paid' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($user->status) }}
                                    </span>

                                     {{-- Pencil icon triggers modal --}}
                                    <a href="#" data-toggle="modal" data-target="#editStatusModal" class="ml-2 text-primary">
                                     <i class="fas fa-pencil-alt"></i>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <th>Roles</th>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge badge-info mr-1">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            @if($user->hasRole('user'))
                             <tr>
                                <th>Premium End Date</th>
                                <td>{{ $user->premium_end_date ? \Carbon\Carbon::parse($user->premium_end_date)->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Registered On</th>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                
                    @if(!$user->hasRole('superadmin'))
                        @canany(['edit.user','delete.user'])
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
                                </div>
                                <div class="card-body text-center">

                                    @if(!$user->hasAnyRole(['user', 'subuser']))
                                        @can('edit.user')
                                            <a href="{{ route('edit.user', $user->id) }}" class="btn btn-primary btn-block mb-3">
                                                <i class="fas fa-edit"></i> Edit User
                                            </a>
                                        @endcan
                                    @endif
                                    
                                
                                    @if(!$user->hasRole('superadmin'))
                                        @can('delete.user')
                                            @if($user->hasRole('user')||$user->hasRole('subuser'))
                                                @if($user->trashed())
                                                    <form action="{{ route('restore.user', $user->id) }}" method="POST" class="d-inline-block w-100">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary btn-block" onclick="return confirm('Are you sure you want to restore this user?')">
                                                            <i class="fas fa-door-open"></i> Enable Customer
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('delete.user', $user->id) }}" method="POST" class="d-inline-block w-100">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this user?')">
                                                            <i class="fas fa-ban"></i> Disable Customer
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                <form action="{{ route('completely.delete.user', $user->id) }}" method="POST" class="d-inline-block w-100">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="fas fa-ban"></i> Delete User
                                                    </button>
                                                </form>
                                            @endif
                                        @endcan
                                    @endif
                                </div>
                            </div>
                        @endcanany
                    @endif



                    <!-- Additional Info (optional) -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Account Info</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Last Updated:</strong> {{ $user->updated_at->diffForHumans() }}</p>
                            <p><strong>Email Verified:</strong> 
                                @if($user->email_verified_at)
                                    <span class="text-success">Yes ({{ $user->email_verified_at->format('M d, Y') }})</span>
                                @else
                                    <span class="text-danger">No</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Edit Status Modal -->
<div class="modal fade" id="editStatusModal" tabindex="-1" role="dialog" aria-labelledby="editStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form  method="POST" action="{{ route('update.status.user', $user->id) }}">
          @csrf
          @method('PUT')
          <div class="modal-content">

              <div class="modal-header">
                  <h5 class="modal-title">Edit User Status</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span>&times;</span>
                  </button>
              </div>

              <div class="modal-body">
  
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" id="statusFreeTrial" value="free_trial" 
                      {{ $user->status === 'free_trial' ? 'checked' : '' }}>
                      <label class="form-check-label" for="statusFreeTrial">Free Trial</label>
                  </div>

                  <!-- Free Trial Days Input -->
                <div class="form-group mt-3" id="freeTrialDaysGroup" style="display: none;">
                    <label for="free_trial_days">Free Trial Days</label>
                    <input type="number" class="form-control" name="free_trial_days" id="free_trial_days" 
                        value="{{ old('free_trial_days', $user->free_trial_days) }}" max="10">
                </div>

  
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" id="statusFree" value="free" 
                      {{ $user->status === 'free' ? 'checked' : '' }}>
                      <label class="form-check-label" for="statusFree">Free</label>
                  </div>
  
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" id="statusPaid" value="paid" 
                      {{ $user->status === 'paid' ? 'checked' : '' }}>
                      <label class="form-check-label" for="statusPaid">Paid</label>
                  </div>

                    <!-- Monthly/Yearly Options -->
                <div class="mt-3" id="planTypeGroup" style="display: none;">
                    <label><strong>Choose Plan:</strong></label><br>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="monthly" value="monthly">
                    <label class="form-check-label" for="monthly">Monthly</label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="yearly" value="yearly">
                    <label class="form-check-label" for="yearly">Yearly</label>
                    </div>
                </div>

                <!-- Premium End Date -->
                <div class="form-group mt-3" id="premiumEndDateGroup" style="display: none;">
                    <label for="premium_end_date">Premium End Date</label>
                    <input type="date" class="form-control" name="premium_end_date" id="premium_end_date" value="{{ old('premium_end_date', $user->premium_end_date) }}">
                </div>
  
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm">Save</button>
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
              </div>
          </div>
      </form>
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
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const paidRadio = document.getElementById("statusPaid");
        const freeTrialRadio = document.getElementById("statusFreeTrial");
        const statusRadios = document.querySelectorAll('input[name="status"]');

        const premiumEndDateGroup = document.getElementById("premiumEndDateGroup");
        const planTypeGroup = document.getElementById("planTypeGroup");
        const freeTrialDaysGroup = document.getElementById("freeTrialDaysGroup");

        const monthly = document.getElementById("monthly");
        const yearly = document.getElementById("yearly");
        const premiumEndDateInput = document.getElementById("premium_end_date");
    
        // Helper to format date to yyyy-mm-dd
        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }
    
        function calculatePremiumDate(planType) {
            const today = new Date();
            if (planType === 'monthly') {
                today.setMonth(today.getMonth() + 1);
            } else if (planType === 'yearly') {
                today.setFullYear(today.getFullYear() + 1);
            }
            premiumEndDateInput.value = formatDate(today);
        }
    
        function togglePremiumFields() {
            if (paidRadio.checked) {
                planTypeGroup.style.display = "block";
                premiumEndDateGroup.style.display = "none";
                freeTrialDaysGroup.style.display = "none";
    
                monthly.addEventListener('change', function () {
                if (monthly.checked) {
                    yearly.checked = false; 
                    premiumEndDateGroup.style.display = "block";
                    calculatePremiumDate('monthly');
                }
            });

            yearly.addEventListener('change', function () {
                if (yearly.checked) {
                    monthly.checked = false; 
                    premiumEndDateGroup.style.display = "block";
                    calculatePremiumDate('yearly');
                }
            });
    
            }else if(freeTrialRadio.checked){
                freeTrialDaysGroup.style.display = "block";
                planTypeGroup.style.display = "none";
                premiumEndDateGroup.style.display = "none";

            } else {
                planTypeGroup.style.display = "none";
                premiumEndDateGroup.style.display = "none";
                freeTrialDaysGroup.style.display = "none";
            }
        }
    
        // On load
        togglePremiumFields();
    
        statusRadios.forEach(r => r.addEventListener("change", togglePremiumFields));
    
    
        [monthly, yearly].forEach(radio => {
            radio.addEventListener("change", function () {
                premiumEndDateGroup.style.display = "block";
                calculatePremiumDate(this.value);
            });
        });
    });
</script>
    
    
@endpush