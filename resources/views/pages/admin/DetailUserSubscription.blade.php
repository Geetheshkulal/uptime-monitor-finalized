@extends('dashboard')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

<style>
.collapse {
    visibility: visible !important; 
}

    .payment-method-container {
        padding: 15px;
        background-color: var(--light);
        border-radius: 5px;
    }
    .method-details {
        background-color: var(--white);
        padding: 15px;
        border-radius: 5px;
        border: 1px solid var(--gray-light);
    }
    .detail-row {
        display: flex;
        align-items: baseline;
    }
    .detail-label {
        min-width: 180px;
        color: var(--secondary);
    }
    .detail-value {
        word-break: break-all;
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

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 white-color">Subscription Details</h1>
        <a href="{{ route('userSubscription') }}" class="d-none d-sm-inline-block btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Subscriptions
        </a>
    </div>

    <div class="row">
        <!-- User Details Card -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#userDetails" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="false" aria-controls="userDetails">
                    <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="userDetails">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>User Name</th>
                                        <td>{{ $subscription->user->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>User Phone</th>
                                        <td>{{ $subscription->user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $subscription->user->email ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>User Since</th>
                                        <td>{{ optional($subscription->user)->created_at->format('d M Y') ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscription Details Card -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#subscriptionDetails" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="subscriptionDetails">
                    <h6 class="m-0 font-weight-bold text-primary">Subscription Details</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="subscriptionDetails">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Plan Name</th>
                                        <td>{{ $subscription->plan_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Recurring Amount</th>
                                        <td>₹{{ $subscription->plan_recurring_amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($subscription->status === 'INITIALIZED')
                                            <span class="badge badge-warning rounded">INITIALIZED</span>
                                        @elseif($subscription->status === 'ACTIVE')
                                            <span class="badge badge-success rounded">ACTIVE</span>
                                        @elseif($subscription->status === 'CANCELLED')
                                            <span class="badge badge-danger rounded">CANCELLED</span>
                                        @else
                                            <span class="badge badge-secondary">{{ ucfirst($subscription->status) }}</span>
                                        @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Subscription ID</th>
                                        <td>{{ $subscription->cashfree_subscription_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Start Date</th>
                                        <td>{{ $subscription->start_date->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>End Date</th>
                                        <td>{{ $subscription->end_date?->format('d M Y') ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Cancelled At</th>
                                        <td>{{ $subscription->cancelled_at?->format('d M Y') ?? '--' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Details Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#paymentDetails" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="paymentDetails">
                    <h6 class="m-0 font-weight-bold text-primary">Payment Details</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="paymentDetails">
                    <div class="card-body">
                        @if(!empty($payments))
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap" id="paymentsTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Payment ID</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Initiated Date</th>
                                            <th>Payment Group</th>
                                            <th>Transaction ID</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payments as $payment)
                                        <tr>
                                            <td>{{ $payment['cf_payment_id'] }}</td>
                                            <td>₹{{ $payment['payment_amount'] }}</td>
                                            <td>
                                                <span class="badge badge-{{ $payment['payment_status'] === 'SUCCESS' ? 'success' : 'danger' }}">
                                                    {{ $payment['payment_status'] }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($payment['payment_initiated_date'])->format('d M Y H:i') }}</td>
                                            <td>{{ strtoupper($subscription->payment_group ?? 'N/A') }}</td>
                                            <td>{{ $payment['cf_txn_id'] ?? 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                <button class="view-payment-details text-info" 
                                                data-payment='@json($payment)'>
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">No payment records found for this subscription</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Detail Modal (for when clicking Details button) -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Payment Details</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="paymentModalBody">
                    Loading payment details...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
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
    // Initialize DataTable
    $('#paymentsTable').DataTable();

    // Handle payment details button click
    $(document).on('click', '.view-payment-details', function() {
    let payment = $(this).data('payment');
    let details = payment.authorization_details || {};
    let methodObj = details.payment_method || {};
    let methodType = Object.keys(methodObj)[0] || 'unknown';
    let methodDetails = methodObj[methodType] || {};
    
    // Start building HTML
    let html = `
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary text-white">
            <h6 class="m-0 font-weight-bold">${methodType.toUpperCase()} Payment Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>`;
    
    // Add each method detail as a table row
    Object.entries(methodDetails).forEach(([key, value]) => {
        if (value) { // Only show non-empty values
            // Format key (replace underscores and capitalize)
            let formattedKey = key.replace(/_/g, ' ')
                                .replace(/\b\w/g, l => l.toUpperCase());
            
            html += `
                        <tr>
                            <th width="30%">${formattedKey}</th>
                            <td>${value}</td>
                        </tr>`;
        }
    });
    
    html += `
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    `;
    
    $('#paymentModalBody').html(html);
    $('#paymentModal').modal('show');
});

});
</script>
@endpush

@endsection