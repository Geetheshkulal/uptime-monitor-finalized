@extends('dashboard')
@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>

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
  background-color: #ccc;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  transform: translateX(26px);
}


.slider.round {
  border-radius: 34px !important;
}

.slider.round:before {
  border-radius: 50%;
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
     .page-content {
        margin-bottom: 175px;
}
.subscription-head{
    padding-bottom: 18px;
}
   
}


    </style>    
@endpush

<div class="page-content">
      <div class="container-fluid">
    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 white-color subscription-head">Subscription Plans</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addSubscriptionModal">
            <i class="fas fa-plus"></i> Add Subscription
        </button>
    </div>

    <!-- Content Row -->
            <div class="card shadow mb-4">
                
                <!-- Card Body -->
                <div class="card-body px-4 py-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                           
                         <thead>
                                <tr>
                                    <th>Plan ID</th>
                                    <th>Plan Name</th>
                                    <th>Amount</th>
                                    <th>Plan Type</th>
                                    <th>Plan recurring amount</th>
                                    <th>Period</th>
                                    <th>Yearly Discount</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $subscription->plan_id }}</td>
                                        <td>{{ $subscription->name }}</td>
                                        <td>{{ number_format($subscription->amount, 2) }}</td>
                                        <td>{{ $subscription->plan_type ? $subscription->plan_type : 'N/A' }}</td>
                                        <td>{{ $subscription->plan_recurring_amount ? $subscription->plan_recurring_amount: 'N/A' }}</td>
                                        <td>{{ ucfirst($subscription->billing_cycle) }}</td>
                                        <td>{{ $subscription->yearly_discount ? $subscription->yearly_discount.'%' : 'N/A' }}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status" 
                                                       data-id="{{ $subscription->id }}"
                                                       {{ $subscription->is_active ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            {{-- <a href="#" 
                                               class=" ml-2 edit-subscription"
                                               title="Edit"
                                               data-toggle="modal" 
                                               data-target="#editSubscriptionModal"
                                               data-id="{{ $subscription->id }}"
                                               data-name="{{ $subscription->name }}"
                                               data-amount="{{ $subscription->amount }}"
                                               data-billing_cycle="{{ $subscription->billing_cycle }}"
                                               data-monthly_discount="{{ $subscription->monthly_discount }}"
                                               data-yearly_discount="{{ $subscription->yearly_discount }}"
                                               data-is_active="{{ $subscription->is_active }}">
                                                <i class="fas fa-edit"  style="color: #2653d4; cursor: pointer;"></i>
                                            </a> --}}

                                            <a href="#" data-toggle="modal" data-target="#deleteCouponModal{{ $subscription->id }}" class="ml-2">
                                                <i class="fas fa-trash" style="color: #e74a3b; cursor: pointer;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No subscription plans available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

</div>
</div>


<!-- Add plan Modal -->
<div class="modal fade" id="addSubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="addSubscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubscriptionModalLabel">Add New Subscription Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('add.billing') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label for="plan_id">Plan ID</label>
                        <input type="text" class="form-control" id="plan_id" name="plan_id" placeholder="Enter Cashfree Plan ID" required>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>
                
                    <div class="form-group col-md-6">
                        <label for="name">Plan Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g., Basic, Pro" required>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="form-group col-md-6">
                        <label for="billing_cycle">Billing Cycle</label>
                        <select class="form-control" id="billing_cycle" name="billing_cycle" required>
                            <option value="">Select Period</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>

                    <div class="form-group yearly-discount-group col-md-6">
                        <label for="yearly_discount">Yearly Discount (%)</label>
                        <input type="number" class="form-control" id="yearly_discount" name="yearly_discount" placeholder="e.g., 20%">
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>
                    </div>

                     <div class="form-group">
                        <label for="amount">Plan Amount (₹)</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="e.g., 300" required>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div> 

                    {{-- <div class="form-group">
                        <label for="plan_type">Plan Type</label>
                        <select class="form-control" id="plan_type" name="plan_type" required>
                            <option value="">Select Type</option>
                            <option value="PERIODIC">PERIODIC (Auto-renew)</option>
                            <option value="ON_DEMAND">ON_DEMAND (Manual Pay)</option>
                        </select>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label>Plan Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="plan_type" id="plan_type" value="PERIODIC" checked required>
                            <label class="form-check-label" for="plan_type_periodic">
                                PERIODIC (Auto-renew)
                            </label>
                        </div>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>

                    
                    <div class="form-group recurring-group">
                        <label for="amount">Plan recurring amount (PERIODIC)</label>
                        <input type="number" class="form-control" id="plan_recurring_amount" name="plan_recurring_amount" placeholder="e.g., 100" required>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Edit Subscription Modal -->
<div class="modal fade" id="editSubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="editSubscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubscriptionModalLabel">Edit Subscription Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editSubscriptionForm" method="POST">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="subscription_id">
                    <div class="form-group">
                        <label for="name">Plan Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" placeholder="eg: Basic, Pro" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="edit_amount" name="amount" required>
            
                    </div>
                    <div class="form-group">
                        <label for="edit_billing_cycle">Billing Cycle</label>
                        <select class="form-control" id="edit_billing_cycle" name="billing_cycle" required>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                    
                    <!-- Yearly Discount (initially hidden if not selected) -->
                    <div class="form-group yearly-discount-group" style="display: none;">
                        <label for="edit_yearly_discount">Yearly Discount (%)</label>
                        <input type="number" class="form-control" id="edit_yearly_discount" name="yearly_discount" placeholder="eg: 10" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
@foreach ($subscriptions as $subscription)
<div class="modal fade" id="deleteCouponModal{{ $subscription->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCouponModalLabel{{ $subscription->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="POST" action="{{ route('subscription.destroy', $subscription->id) }}">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCouponModalLabel{{ $subscription->id }}">Delete Subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    
            <div class="modal-body">
                <p>Are you sure you want to delete this coupon: <strong>{{ $subscription->name }}</strong>?</p>
                <p>This action cannot be undone.</p>
            </div>
    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete Subscription</button>
            </div>
        </form>
    </div>
</div>
@endforeach

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@if ($errors->any())
<script>
    $(document).ready(function () {
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
        $('#addSubscriptionModal').modal('show');
    });
</script>
@endif

<script>

@if (session('success'))
toastr.success("{{ session('success') }}");
@endif


    $(document).ready(function () {
        $('#dataTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "order": [[0, "asc"]]
        });


        // Show/hide discount fields selection
    //     $('#billing_cycle').on('change', function() {
    //     const selected = $(this).val();
    //     if (selected === 'yearly') {
    //         $('.yearly-discount-group').show();
    //         $('#yearly_discount').attr('required', 'required');
    //     } else {
    //         $('.yearly-discount-group').hide();
    //         $('#yearly_discount').removeAttr('required');
    //     }
    // });

    
    // When opening the modal with existing data
    // $(document).on('click', '.edit-subscription', function() {
    //     var billingCycle = $(this).data('billing_cycle');
        
    //     // Trigger the change event to show correct discount field
    //     $('#edit_billing_cycle').val(billingCycle).change();
        

    //     if(billingCycle === 'monthly') {
    //         $('#edit_monthly_discount').val($(this).data('monthly_discount'));
    //     } else {
    //         $('#edit_yearly_discount').val($(this).data('yearly_discount'));
    //     }
    // });

     

        // Handle edit button click
        // $('.edit-subscription').on('click', function() {
        //     var id = $(this).data('id');
        //     var name = $(this).data('name');
        //     var amount = $(this).data('amount');
        //     var billingPeriod = $(this).data('billing_cycle');
        //     var monthlyDiscount = $(this).data('monthly_discount');
        //     var yearlyDiscount = $(this).data('yearly_discount');
        //     var isActive = $(this).data('is_active');
            
        //     $('#subscription_id').val(id);
        //     $('#edit_name').val(name);
        //     $('#edit_amount').val(amount);
        //     $('#edit_billing_cycle').val(billingPeriod);
        //     $('#edit_monthly_discount').val(monthlyDiscount);
        //     $('#edit_yearly_discount').val(yearlyDiscount);
        //     $('#edit_is_active').prop('checked', isActive);
            
        //     $('#editSubscriptionForm').attr('action', '{{ route('edit.billing','')}}/' + id);
        // });

         // Handle toggle switch
     $(document).on('change', '.toggle-status', function() {
        var $checkbox = $(this);
        var subscriptionId = $checkbox.data('id');
        var isActive = $checkbox.is(':checked');
        
        $checkbox.prop('disabled', true);
        
        $.ajax({
            url: '/toggle-active/' + subscriptionId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                is_active: isActive
            },
            success: function(response) {
                if(response.success) {
                    toastr.success('Status updated successfully');
                } else {
                    // Revert if server indicates failure
                    $checkbox.prop('checked', !isActive);
                    toastr.error(response.message || 'Failed to update status');
                }
            },
            error: function(xhr) {
                // Revert on error
                $checkbox.prop('checked', !isActive);
                toastr.error('Error: ' + (xhr.responseJSON?.message || 'Server error'));
            },
            complete: function() {
                // Re-enable checkbox
                $checkbox.prop('disabled', false);
            }
        });
    });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const billingCycle = document.getElementById('billing_cycle');
        const yearlyDiscountGroup = document.querySelector('.yearly-discount-group');
        const planType = document.getElementById('plan_type');
        const recurringGroup = document.querySelector('.recurring-group');
        const form = document.querySelector('form');

    
        // Real-time validation
        const fields = form.querySelectorAll('input, select');
        fields.forEach(field => {
            field.addEventListener('input', function () {
                validateField(this);
            });
        });
    
        function validateField(field) {
            let isValid = true;
            const value = field.value.trim();
            const type = field.getAttribute('type');
            const id = field.id;
    
            field.classList.remove('is-invalid');
    
            if (field.hasAttribute('required') && value === '') {
                isValid = false;
            } else if (type === 'number' && value !== '' && isNaN(value)) {
                isValid = false;
            } else if (id === 'yearly_discount' && billingCycle.value !== 'yearly') {
                isValid = true; // Skip validation if not yearly
            } else if (id === 'plan_recurring_amount' && planType.value !== 'PERIODIC') {
                isValid = true; // Skip if not PERIODIC
            }
    
            if (!isValid) {
                field.classList.add('is-invalid');
            }
        }
    
        // On submit check all fields again
        form.addEventListener('submit', function (e) {
            let hasError = false;
            fields.forEach(field => {
                validateField(field);
                if (field.classList.contains('is-invalid')) {
                    hasError = true;
                }
            });
    
            if (hasError) {
                e.preventDefault();
                alert('Please correct the highlighted fields.');
            }
        });
    });
    </script>
    

@endpush

@endsection