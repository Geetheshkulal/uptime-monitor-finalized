@extends('dashboard')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

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
                background-color: var(--gray-light);
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: var(--white);
                transition: .4s;
            }

            input:checked+.slider {
                background-color: var(--primary);
            }

            input:focus+.slider {
                box-shadow: 0 0 1px var(--primary);
            }

            input:checked+.slider:before {
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

                .dataTables_filter {
                    margin-left: -8px;
                }

                .page-content {
                    margin-bottom: 175px;
                }

                .subscription-head {
                    padding-bottom: 18px;
                }

            }

            /* Remove default background from tabs */
            .nav-tabs .nav-link {
                background-color: transparent !important;
                border: none !important;
                color: var(--secondary);
            }

            .nav-tabs .nav-link.active {
                background-color: transparent !important;
                border: none !important;
                color: var(--secondary);
                /* highlight active tab text */
                font-weight: 600;
                border-bottom: 2px solid var(--primary) !important;
                /* underline effect */
            }
        </style>
    @endpush

    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Heading -->

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 white-color subscription-head">Plans</h1>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addSubscriptionModal">
                    <i class="fas fa-plus"></i> Add Plan
                </button>
            </div>

            <!-- Content Row -->
            <div class="card shadow mb-4">

                <!-- Card Body -->
                <div class="card-body px-4 py-4">
                    <div class="table-responsive">
                        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Plan ID</th>
                                    <th>Plan Name</th>
                                    <th>Amount</th>
                                    <th>Discount percentage</th>
                                    <th>Sale Price</th>
                                    <th>Plan Type</th>
                                    <th>Plan recurring amount</th>
                                    <th>Period</th>
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
                                        <td>{{ $subscription->percentage_discount }}</td>
                                        <td>{{ $subscription->sale_price }}</td>
                                        <td>{{ $subscription->plan_type ? $subscription->plan_type : 'N/A' }}</td>
                                        <td>{{ $subscription->plan_recurring_amount ? $subscription->plan_recurring_amount : 'N/A' }}
                                        </td>
                                        <td>{{ ucfirst($subscription->billing_cycle) }}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $subscription->id }}"
                                                    {{ $subscription->is_active ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.features.edit', $subscription->id) }}" class=" ml-2"
                                                title="Edit">
                                                <i class="fas fa-edit" style="color: #2653d4; cursor: pointer;"></i>
                                            </a>

                                            <a href="#" data-toggle="modal"
                                                data-target="#deleteCouponModal{{ $subscription->id }}" class="ml-2">
                                                <i class="fas fa-trash" style="color: #e74a3b; cursor: pointer;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No subscription plans available
                                        </td>
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
    <div class="modal fade" id="addSubscriptionModal" tabindex="-1" role="dialog"
        aria-labelledby="addSubscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addSubscriptionModalLabel">Add New Subscription Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Tabs -->
                <ul class="nav nav-tabs nav-fill" id="subscriptionTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="monthly-tab" data-toggle="tab" href="#monthly" role="tab"
                            aria-controls="monthly" aria-selected="true">Monthly</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="yearly-tab" data-toggle="tab" href="#yearly" role="tab"
                            aria-controls="yearly" aria-selected="false">Yearly</a>
                    </li>
                </ul>

                <div class="tab-content" id="subscriptionTabsContent">
                    <!-- Monthly Form -->
                    <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                        <form method="POST" action="{{ route('add.billing') }}">
                            @csrf
                            <input type="hidden" name="billing_cycle" value="monthly">
                            <div class="modal-body">
                                <div class="row">
                                    <input type="text" class="form-control" id="plan_id" name="plan_id" hidden
                                        placeholder="Auto-generated">

                                    <div class="form-group col-md-6">
                                        <label for="name">Plan Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="e.g., Basic, Pro" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="amount">Regular Price (₹)</label>
                                        <input type="number" class="form-control" id="amount" name="amount"
                                            placeholder="e.g., 300" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="percentage_discount">Discount (%)</label>
                                        <input type="number" class="form-control" id="percentage_discount"
                                            name="percentage_discount" placeholder="e.g., 15">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="sale_price">Sale Price (₹)</label>
                                        <input type="number" class="form-control" id="sale_price" name="sale_price"
                                            placeholder="e.g., 250">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add Monthly Plan</button>
                            </div>
                        </form>
                    </div>

                    <!-- Yearly Form -->
                    <div class="tab-pane fade" id="yearly" role="tabpanel" aria-labelledby="yearly-tab">
                        <form method="POST" action="{{ route('add.billing') }}">
                            @csrf
                            <input type="hidden" name="billing_cycle" value="yearly">
                            <div class="modal-body">
                                <div class="row">
                                    <input type="text" class="form-control" id="plan_id_yearly" name="plan_id" hidden
                                        placeholder="Auto-generated">
                                    <div class="form-group col-md-6">
                                        <label for="name_yearly">Plan Name</label>
                                        <input type="text" class="form-control" id="name_yearly" name="name"
                                            placeholder="e.g., Basic, Pro" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="amount_yearly">Regular Price (₹)</label>
                                        <input type="number" class="form-control" id="amount_yearly" name="amount"
                                            placeholder="e.g., 3000" required>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="percentage_discount_yearly">Discount (%)</label>
                                        <input type="number" class="form-control" id="percentage_discount_yearly"
                                            name="percentage_discount" placeholder="e.g., 20">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="sale_price_yearly">Sale Price (₹)</label>
                                        <input type="number" class="form-control" id="sale_price_yearly"
                                            name="sale_price" placeholder="e.g., 2500">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add Yearly Plan</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Edit Subscription Modal -->
    <div class="modal fade" id="editSubscriptionModal" tabindex="-1" role="dialog"
        aria-labelledby="editSubscriptionModalLabel" aria-hidden="true">
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
                            <input type="text" class="form-control" id="edit_name" name="name"
                                placeholder="eg: Basic, Pro" required>
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
                            <input type="number" class="form-control" id="edit_yearly_discount" name="yearly_discount"
                                placeholder="eg: 10" required>
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
        <div class="modal fade" id="deleteCouponModal{{ $subscription->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteCouponModalLabel{{ $subscription->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="modal-content" method="POST"
                    action="{{ route('subscription.destroy', $subscription->id) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCouponModalLabel{{ $subscription->id }}">Delete Subscription
                        </h5>
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
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

        @if ($errors->any())
            <script>
                $(document).ready(function() {
                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}");
                    @endforeach
                    $('#addSubscriptionModal').modal('show');
                });
            </script>
        @endif

        @if (!empty($ErrorMessage))
            <script>
                toastr.error("{{ $ErrorMessage }}");
            </script>
        @endif


        <script>
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif


            $(document).ready(function() {
                $('#dataTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "order": [
                        [0, "asc"]
                    ],
                    "responsive": true
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

                //     $('#editSubscriptionForm').attr('action', '{{ route('edit.billing', '') }}/' + id);
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
                            if (response.success) {
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
            $(document).ready(function() {

                function calculateSalePrice() {
                    let amount = parseFloat($("#amount").val());
                    let discount = parseFloat($("#percentage_discount").val());

                    if (!isNaN(amount) && !isNaN(discount)) {
                        let salePrice = amount - (amount * discount / 100);
                        $("#sale_price").val(salePrice.toFixed(2));
                    }
                }

                function calculateDiscount() {
                    let amount = parseFloat($("#amount").val());
                    let salePrice = parseFloat($("#sale_price").val());

                    if (!isNaN(amount) && !isNaN(salePrice) && amount > 0) {
                        let discount = ((amount - salePrice) / amount) * 100;
                        $("#percentage_discount").val(discount.toFixed(2));
                    }
                }

                // When typing in Discount %
                $("#percentage_discount").on("input", function() {
                    calculateSalePrice();
                });

                // When typing in Sale Price
                $("#sale_price").on("input", function() {
                    calculateDiscount();
                });

                // Recalculate if Regular Price changes
                $("#amount").on("input", function() {
                    if ($("#percentage_discount").val()) {
                        calculateSalePrice();
                    } else if ($("#sale_price").val()) {
                        calculateDiscount();
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {

                // ---------- MONTHLY ----------
                function calculateSalePriceMonthly() {
                    let amount = parseFloat($("#amount").val());
                    let discount = parseFloat($("#percentage_discount").val());

                    if (!isNaN(amount) && !isNaN(discount)) {
                        let salePrice = amount - (amount * discount / 100);
                        $("#sale_price").val(salePrice.toFixed(2));
                    }
                }

                function calculateDiscountMonthly() {
                    let amount = parseFloat($("#amount").val());
                    let salePrice = parseFloat($("#sale_price").val());

                    if (!isNaN(amount) && !isNaN(salePrice) && amount > 0) {
                        let discount = ((amount - salePrice) / amount) * 100;
                        $("#percentage_discount").val(discount.toFixed(2));
                    }
                }

                $("#percentage_discount").on("input", function() {
                    calculateSalePriceMonthly();
                });

                $("#sale_price").on("input", function() {
                    calculateDiscountMonthly();
                });

                $("#amount").on("input", function() {
                    if ($("#percentage_discount").val()) {
                        calculateSalePriceMonthly();
                    } else if ($("#sale_price").val()) {
                        calculateDiscountMonthly();
                    }
                });


                // ---------- YEARLY ----------
                function calculateSalePriceYearly() {
                    let amount = parseFloat($("#amount_yearly").val());
                    let discount = parseFloat($("#percentage_discount_yearly").val());

                    if (!isNaN(amount) && !isNaN(discount)) {
                        let salePrice = amount - (amount * discount / 100);
                        $("#sale_price_yearly").val(salePrice.toFixed(2));
                    }
                }

                function calculateDiscountYearly() {
                    let amount = parseFloat($("#amount_yearly").val());
                    let salePrice = parseFloat($("#sale_price_yearly").val());

                    if (!isNaN(amount) && !isNaN(salePrice) && amount > 0) {
                        let discount = ((amount - salePrice) / amount) * 100;
                        $("#percentage_discount_yearly").val(discount.toFixed(2));
                    }
                }

                $("#percentage_discount_yearly").on("input", function() {
                    calculateSalePriceYearly();
                });

                $("#sale_price_yearly").on("input", function() {
                    calculateDiscountYearly();
                });

                $("#amount_yearly").on("input", function() {
                    if ($("#percentage_discount_yearly").val()) {
                        calculateSalePriceYearly();
                    } else if ($("#sale_price_yearly").val()) {
                        calculateDiscountYearly();
                    }
                });

            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const billingCycle = document.getElementById('billing_cycle');
                const yearlyDiscountGroup = document.querySelector('.yearly-discount-group');
                const planType = document.getElementById('plan_type');
                const recurringGroup = document.querySelector('.recurring-group');
                const form = document.querySelector('form');


                // Real-time validation
                const fields = form.querySelectorAll('input, select');
                fields.forEach(field => {
                    field.addEventListener('input', function() {
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
                form.addEventListener('submit', function(e) {
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
        <script>
            function GenerateRandomID(prefix = "CF") {
                console.log(prefix + "_" + Math.random().toString(36).substring(2, 10).toUpperCase());
                return prefix + "_" + Math.random().toString(36).substring(2, 10).toUpperCase();
            }


            // When modal opens, generate IDs for both monthly & yearly
            $('#addSubscriptionModal').on('show.bs.modal', function() {
                $("#plan_id").val(GenerateRandomID("PLAN")); // Monthly plan_id
                $("#plan_id_yearly").val(GenerateRandomID("PLAN")); // Yearly plan_id
            });
        </script>
    @endpush
@endsection
