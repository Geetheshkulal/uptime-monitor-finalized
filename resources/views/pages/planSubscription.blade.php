@extends('dashboard')
@section('content')

@push('styles')
     {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <style>
        /* Table styles */
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table thead th {
            border: none;
            font-weight: 700;
            color: #858796;
            padding: 1rem;
            background: #f8f9fc;
        }
        
        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid #e3e6f0;
        }

        /* Print Bill Styles */
        @media print {
            body * {
                visibility: hidden;
            }
            .print-bill-template, .print-bill-template * {
                visibility: visible;
            }
            .print-bill-template {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 0;
                margin: 0;
            }

            .no-print {
                display: none !important;
            }
        }
        
        .print-bill-template {
            position: absolute;
            left: -9999px;
            top: -9999px;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .bill-container {
            padding: 40px;
        }

        .bill-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .company-info {
            text-align: left;
        }

        .company-name {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .company-tagline {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .company-address {
            font-size: 13px;
            line-height: 1.6;
            color: #555;
        }

        .bill-title {
            font-size: 28px;
            font-weight: 300;
            color: #3498db;
            margin-bottom: 10px;
            text-align: right;
        }

        .bill-meta {
            text-align: right;
            font-size: 13px;
        }

        .bill-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .bill-from, .bill-to {
            flex: 1;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 5px;
        }

        .bill-to {
            margin-left: 20px;
            background: #f1f8fe;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }

        .bill-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }

        .bill-table thead th {
            background: #3498db;
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 500;
        }

        .bill-table tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        .bill-table tbody tr:last-child td {
            border-bottom: none;
        }

        .bill-table tfoot td {
            padding: 12px 15px;
            font-weight: 600;
            background: #f9f9f9;
        }

        .bill-summary {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .total-box {
            width: 300px;
            padding: 15px;
            background: #f1f8fe;
            border-radius: 5px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .total-label {
            font-weight: 600;
        }

        .total-amount {
            font-weight: 700;
            color: #2c3e50;
        }

        .grand-total {
            font-size: 18px;
            color: #3498db;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
        }

        .bill-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #7f8c8d;
            text-align: center;
        }

        .thank-you {
            font-size: 16px;
            color: #3498db;
            margin-bottom: 10px;
        }

        .signature-area {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature-line {
            border-top: 1px solid #ccc;
            width: 200px;
            margin-top: 40px;
            text-align: center;
            padding-top: 5px;
            font-size: 12px;
        }
    body.dark-mode .skeleton{
        background-color: #1e1e2f !important;
    }

    .table-responsive {
    scrollbar-width: none;       /* Firefox */
    -ms-overflow-style: none;    /* IE 10+ */
    overflow-x: auto;            /* Still scrollable */
}




@media (max-width: 578px) {

.dataTables_length {
   text-align: left !important;
   margin-left: 2px;
   margin-bottom: 10px;
}

.dataTables_filter{
    margin-left: -33px
}

.page-content {
   margin-bottom: 175px;
}
.eyeCancel{
    margin-top: -21px;
}

}

    .section-title {
        color: #4e73df;
        font-weight: 600;
        border-bottom: 1px solid #e3e6f0;
        padding-bottom: 8px;
        margin-bottom: 15px;
    }
    .detail-row {
        display: flex;
        margin-bottom: 10px;
    }
    .detail-label {
        flex: 1;
        font-weight: 600;
        color: #5a5c69;
    }
    .detail-value {
        flex: 1;
        color: #858796;
    }
    .subscription-section {
        background: #f8f9fc;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .payment-method-details {
    margin-top: 10px;
}
.detail-row.indent {
    margin-left: 20px;
}
.detail-row.indent .detail-label {
    font-weight: normal;
}
</style>
@endpush

{{-- <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <!-- Payments Table -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4 ml-2">
                <h1 class="h3 mb-0 text-gray-800 font-600 white-color">My Payment History</h1>
            </div>
            <div class="card shadow mb-4 skeleton" data-aos="fade-up" data-aos-duration="400">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped dt-responsive  nowrap" id="paymentsTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>                               
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Payment Type</th>
                                    <th>Payment Status</th>
                                    <th>Transaction Id</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Coupon Code</th>
                                    <th>Discount</th>
                                    <th>Final Amount</th>
                                    <th>Print Bill</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subscriptions as $subscription)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>₹{{ number_format($subscription->subscription->amount, 2) }}</td>
                                    <td>
                                        @if($subscription->status === 'active')
                                            <span class="badge badge-success">Active</span>
                                        @elseif($subscription->status === 'expired')
                                            <span class="badge badge-danger">Expired</span>
                                        @else
                                            <span class="badge badge-warning">{{ ucfirst($subscription->status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ strtoupper($subscription->payment_type) }}</td>
                                    <td>{{ strtoupper($subscription->payment_status) }}</td>
                                    <td>{{ $subscription->transaction_id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($subscription->end_date)->format('d M Y') }}</td>
                                    @if ($subscription->coupon_code)
                                        <td><span class="badge badge-warning">{{ $subscription->coupon_code }}</span></td>
                                    @else
                                        <td><span class="">Not Applied</span></td>
                                    @endif
                                    <td>
                                        @if($subscription->coupon_value)
                                            @if($subscription->discount_type === 'percentage')
                                                {{ $subscription->coupon_value }}%
                                            @elseif($subscription->discount_type === 'flat')
                                                ₹{{ $subscription->coupon_value }}
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $subscription->payment_amount }}</td>
                                    <td><button class="btn btn-sm btn-primary print-bill" 
                                        data-id="{{ $subscription->id }}"
                                        data-address="{{ $subscription->address }}"
                                        data-city="{{ $subscription->city }}"
                                        data-state="{{ $subscription->state }}"
                                        data-country="{{ $subscription->country }}"
                                        data-pincode="{{ $subscription->pincode }}"
                                        data-coupon-code="{{ $subscription->coupon_code }}"
                                        data-coupon-value="{{ $subscription->coupon_value }}"
                                        data-final-amount="{{ $subscription->payment_amount }}"
                                        data-discount-type="{{$subscription->discount_type}}"
                                        >Print Bill</button></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No payment history found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <!-- Payments Table -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4 ml-2">
                <h1 class="h3 mb-0 text-gray-800 font-600 white-color">My Payment History</h1>
            </div>
            <div class="card shadow mb-4 skeleton" data-aos="fade-up" data-aos-duration="400">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped dt-responsive nowrap" id="paymentsTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Plan Name</th>
                                    <th>Amount</th>
                                    <th>Subscription Id</th>
                                    <th>Plan Recurring Amount</th>
                                    <th>Start Date</th>
                                    {{-- <th>End Date</th> --}}
                                    <th>Next Payment</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subscriptions as $subscription)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subscription->plan_name }}</td>
                                    <td>₹{{ number_format($subscription->plan_max_amount, 2) }}</td>
                                    <td>
                                        {{ $subscription->cashfree_subscription_id ?? 'N/A' }}
                                    </td>
                                    <td>{{ $subscription->plan_recurring_amount ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y') }}</td>
                                    {{-- <td>{{ \Carbon\Carbon::parse($subscription->end_date)->format('d M Y') }}</td> --}}
                                    <td>
                                        @if($subscription->next_schedule_date)
                                            {{ \Carbon\Carbon::parse($subscription->next_schedule_date)->format('d M Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscription->status === 'ACTIVE')
                                            <span class="badge badge-success">Active</span>
                                        @elseif($subscription->status === 'EXPIRED')
                                            <span class="badge badge-danger">Expired</span>
                                        @elseif($subscription->status === 'INITIALIZED')
                                            <span class="badge badge-warning">Initialized</span>
                                            @elseif($subscription->status === 'INITIALIZED')
                                            <span class="badge badge-warning">Initialized</span>
                                        @else
                                            <span class="badge badge-secondary">{{ ucfirst(strtolower($subscription->status)) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2 eyeCancel">
                                        <button class="fas fa-eye" 
                                            data-toggle="modal" 
                                            data-target="#subscriptionDetailsModal"
                                            data-subscription="{{ json_encode($subscription) }}"
                                            data-payment ="{{json_encode($payments->get($subscription->cashfree_subscription_id))}}" style="color: #2c4ee5; cursor: pointer;">
                                        </button>
                                        
                                        @if($subscription->status === 'ACTIVE')
                                            <!-- Ban icon triggers delete modal -->
                                            <a href="#" data-toggle="modal" data-target="#cancelSubscriptionModal{{ $subscription->id }}">
                                                <i class="fas fa-ban" style="color: #f91a1a; cursor: pointer;"></i>
                                            </a>
                                            @endif
                                    </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">No subscription history found.</td>
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

@foreach ($subscriptions as $subscription)
<div class="modal fade" id="cancelSubscriptionModal{{ $subscription->id }}" tabindex="-1" role="dialog" aria-labelledby="cancelSubscriptionLabel{{ $subscription->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="POST" action="{{ route('subscriptions.cancel', $subscription->cashfree_subscription_id) }}">
            @csrf
            <!-- Use POST unless your route expects DELETE -->
            <div class="modal-header">
                <h5 class="modal-title" id="cancelSubscriptionLabel{{ $subscription->id }}">Cancel Subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to cancel the subscription for: <strong>{{ $subscription->plan_name ?? 'N/A' }}</strong>?</p>
                <p>This action cannot be undone.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes, Cancel</button>
            </div>
        </form>
    </div>
</div>
@endforeach

  

<!-- Details Modal -->
<div class="modal fade" id="subscriptionDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subscription ID: <span id="modalSubscriptionId"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="subscriptionDetailsContent">
                <div class="row">
                    <div class="col-md-6">
                        <div class="subscription-section">
                            <div class="detail-row">
                                <span class="detail-label">Plan Type</span>
                                <span class="detail-value" id="planType"></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Max Amount</span>
                                <span class="detail-value" id="maxAmount"></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Start Date</span>
                                <span class="detail-value" id="startDate"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="subscription-section">
                            <div class="detail-row">
                                <span class="detail-label">End Date</span>
                                <span class="detail-value" id="endDate"></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Cancelled At</span>
                                <span class="detail-value" id="cancelledAt"></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Payment Group</span>
                                <span class="detail-value" id="paymentGroup"></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Payment status</span>
                                <span class="detail-value" id="paymentStatus"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="subscription-section">
                            <h6 class="section-title">Payment Method Details</h6>
                            <div id="paymentMethodDetails"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Hidden Bill Template -->
{{-- <div id="print-bill-template" class="print-bill-template" style="display: none;">
    <div class="bill-container">
        <div class="bill-header">
            <div class="company-info">
                <div class="company-name">DRISHTI PULSE</div>
                <div class="company-tagline">Website Monitoring Solutions</div>
                <div class="company-address">
                    3rd Floor VSK Towers kottara chowki,<br>
                    Mangalore, Karnataka 560001<br>
                    India<br>
                    GSTIN: 29AAICD0310K1ZT<br>
                    Phone: +91 8073462033<br>
                    Email: drishtipulse2025@gmail.com
                </div>
            </div>
            <div class="invoice-info">
                <div class="bill-title">INVOICE</div>
                <div class="bill-meta">
                    <div><strong>Invoice #:</strong> <span id="bill-transaction-id"></span></div>
                    <div><strong>Date:</strong> <span id="bill-date"></span></div>
                </div>
            </div>
        </div>

        <div class="bill-details">
            <div class="bill-from">
                <div class="section-title">From:</div>
                <div>
                    <strong></strong><br>
                    3rd Floor VSK Towers kottara chowki,<br>
                    Mangalore, Karnataka 560001<br>
                    India<br>
                    GSTIN: 29AAICD0310K1ZT
                </div>
            </div>
            <div class="bill-to">
                <div class="section-title">Bill To:</div>
                <div>
                    <strong>{{ Auth::user()->name }}</strong><br>
                    <span id="bill-address">
                        <!-- Address will be populated here -->
                    </span>
                </div>
            </div>
        </div>

        <table class="bill-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$subscription->subscription->name}}</td>
                    <td id="bill-amount"></td>
                </tr>
                <tr style="display: none;" id="bill-coupon-row">
                    <td id="coupon-title"></td>
                    <td id="bill-discount"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td><strong>Total</strong></td>
                    <td id="bill-total"></td>
                </tr>
            </tfoot>
        </table>

        <div class="bill-summary">
            <div class="total-box">
                <div class="total-row">
                    <span class="total-label">Subtotal:</span>
                    <span class="total-amount" id="bill-subtotal"></span>
                </div>
                <div class="total-row">
                    <span class="total-label">Tax (0%):</span>
                    <span class="total-amount">₹0.00</span>
                </div>
                <div class="total-row grand-total">
                    <span class="total-label">Total:</span>
                    <span class="total-amount" id="bill-grand-total"></span>
                </div>
            </div>
        </div>

        <div class="additional-info">
            <div><strong>Payment Method:</strong> <span id="bill-payment-type"></span></div>
            <div><strong>Payment Status:</strong> <span id="bill-payment-status"></span></div>
            <div><strong>Subscription Period:</strong> <span id="bill-start-date"></span> to <span id="bill-end-date"></span></div>
        </div>

        <div class="signature-area">
            <div class="signature-line">Customer Signature</div>
            <div class="signature-line">DRISHTI PULSE</div>
        </div>

        <div class="bill-footer">
            <div class="thank-you">Thank you for your business!</div>
            <div>This is computer generated receipt and does not require physical signature.</div>
            <div>If you have any questions about this invoice, please contact our support at drishtipulse2025@gmail.com</div>
        </div>
    </div>
</div> --}}

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

let dataTable;

function initDataTable() {
  // Destroy existing instance if any
  if ($.fn.DataTable.isDataTable('#paymentsTable')) {
    dataTable.destroy();
  }

  const isMobile = window.innerWidth < 768;

  dataTable = $('#paymentsTable').DataTable({
    "order": [[6, "desc"]],
    "paging": true,
    "searching": true,
    "ordering": true,
    "info": true,
    responsive: isMobile, 
    scrollX: false,
    stateSave: true,
    columnDefs: [
      { className: 'dtr-control', targets: 0 },
      { responsivePriority: 1, targets: '_all' }
    ]
  });
}

$(document).ready(function() {

    initDataTable();

    $(window).on('resize', function () {
      clearTimeout(window.resizeTimer);
      window.resizeTimer = setTimeout(function () {
        initDataTable();
      }, 300);
    });

        // $('#paymentsTable').DataTable({
        //     "order": [[6, "desc"]],
        //     "paging": true,
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     responsive: true,
        //     scrollX: false,
        //     stateSave: true
            
        // });

        // Print Bill Functionality
        $(document).on('click', '.print-bill', function() {
            const row = $(this).closest('tr');
            const subscriptionId = $(this).data('id');
            const amount = row.find('td:eq(1)').text();
            const paymentType = row.find('td:eq(3)').text();
            const paymentStatus = row.find('td:eq(4)').text();
            const transactionId = row.find('td:eq(5)').text();
            const startDate = row.find('td:eq(6)').text();
            const endDate = row.find('td:eq(7)').text();

            
            // Get address details from data attributes
            const address = $(this).data('address');
            const city = $(this).data('city');
            const state = $(this).data('state');
            const country = $(this).data('country');
            const pincode = $(this).data('pincode');

            const couponCode = $(this).data('coupon-code');
            const couponValue = $(this).data('coupon-value');
            const finalAmount = $(this).data('final-amount');
            const discountType = $(this).data('discount-type');
    
            
            // Format the current date for the bill
            const today = new Date();
            const formattedDate = today.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
            
            // Populate the bill template
            $('#bill-date').text(formattedDate);
            $('#bill-transaction-id').text('INV-' + transactionId);
            $('#bill-amount').text(amount);
            $('#bill-subtotal').text(finalAmount);
            $('#bill-total').text(amount);
            $('#bill-grand-total').text(finalAmount);
            $('#bill-payment-type').text(paymentType);
            $('#bill-payment-status').text(paymentStatus);
            $('#bill-start-date').text(startDate);
            $('#bill-end-date').text(endDate);


            if(couponCode && couponValue) {
                $('#bill-coupon-row').show();
                $('#coupon-title').text('Coupon Code-' + couponCode);
                const cleanAmount = amount.replace(/[^\d.-]/g, ''); 
                $('#bill-discount').text(
                    (discountType==='flat')?'- ₹' + couponValue:
                    `-₹${Math.floor(Number(cleanAmount)*Number(couponValue)/100)}(${couponValue}%)`
                );
                $('#bill-total').text(finalAmount);
            } else {
                $('#bill-coupon-row').hide();
                $('#coupon-title').text('');
                $('#bill-discount').text('');
            }
            
            // Populate address
            let addressHtml = '';
            if (address) addressHtml += address + '<br>';
            if (city) addressHtml += city;
            if (state) addressHtml += ', ' + state;
            if (pincode) addressHtml += ' - ' + pincode;
            if (country) addressHtml += '<br>' + country;
            
            $('#bill-address').html(addressHtml || 'No address provided');
            
            // Show the template temporarily
            const billTemplate = $('#print-bill-template');
            const printClone = billTemplate.clone().attr('id', 'print-clone');
            
            printClone.css({
                'position': 'fixed',
                'left': '-9999px',
                'top': '0',
                'display': 'block',
                'z-index': '99999'
            }).appendTo('body');
        
        // Use html2canvas on the clone
        html2canvas(printClone[0], {
            scale: 2,
            logging: false,
            useCORS: true,
            scrollX: 0,
            scrollY: 0,
            windowWidth: printClone[0].scrollWidth,
            windowHeight: printClone[0].scrollHeight
        }).then(canvas => {
            // Remove the clone immediately after capturing
            printClone.remove();
            
            // Create PDF
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'pt', 'a4');
            const imgData = canvas.toDataURL('image/png');
            const imgWidth = pdf.internal.pageSize.getWidth() - 40;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            
            pdf.addImage(imgData, 'PNG', 20, 20, imgWidth, imgHeight);
            pdf.save(`Invoice_${transactionId}.pdf`);
        });
    });
});
</script>


<script>

     document.addEventListener("DOMContentLoaded", function() {
    @if(session('success'))
        toastr.success("{{ session('success') }}", "Success", {
            closeButton: true,
            // progressBar: true,
            // positionClass: "toast-top-right",
            // timeOut: 5000
        });
    @endif
});

    $(document).ready(function() {
        $('#subscriptionDetailsModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var subscription = button.data('subscription');
            var payment = button.data('payment');
            var modal = $(this);
            
            // Format dates
            function formatDate(dateString) {
                if (!dateString) return 'Not available';
                var date = new Date(dateString);
                return date.toLocaleDateString('en-IN', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                }) + (dateString.includes('T') ? ', ' + date.toLocaleTimeString('en-IN', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                }) : '');
            }
    
            // Set header
            $('#modalSubscriptionId').text(subscription.cashfree_subscription_id || '--');
            
            // Set basic details
            $('#planType').text(subscription.plan_type || 'Not available');
            $('#maxAmount').text('₹' + (subscription.plan_max_amount ? subscription.plan_max_amount: '--'));
            $('#startDate').text(formatDate(subscription.start_date));
            $('#endDate').text(formatDate(subscription.end_date));
            $('#cancelledAt').text(subscription.cancelled_at ? formatDate(subscription.cancelled_at) : '--');
            $('#paymentGroup').text(subscription.payment_group ? subscription.payment_group.toUpperCase() : '--');
            $('#paymentStatus').text(payment.payment_status ? payment.payment_status.toUpperCase() : '--');
            
         // Payment Method details
            var paymentMethodHtml = '';
            if (subscription.payment_method) {
                try {
                    // Parse payment_method if it's a string, otherwise use directly
                    var paymentData = typeof subscription.payment_method === 'string' 
                        ? JSON.parse(subscription.payment_method) 
                        : subscription.payment_method;
                    
                    if (paymentData && typeof paymentData === 'object') {
                        paymentMethodHtml = '<div class="payment-method-details">';
                        
                        for (const [paymentType, details] of Object.entries(paymentData)) {
                            paymentMethodHtml += `
                                <div class="detail-row">
                                    <span class="detail-label">${paymentType.toUpperCase()}</span>
                                    <span class="detail-value"></span>
                                </div>
                            `;
                            
                            // Loop through all properties of this payment type
                            for (const [key, value] of Object.entries(details)) {
                                if (value !== null && value !== undefined && value !== '') {
                                    paymentMethodHtml += `
                                        <div class="detail-row indent">
                                            <span class="detail-label">${key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}</span>
                                            <span class="detail-value">${value || '--'}</span>
                                        </div>
                                    `;
                                }
                            }
                        }
                        
                        paymentMethodHtml += '</div>';
                    } else {
                        paymentMethodHtml = '<div class="detail-row"><span class="detail-value">No payment details available</span></div>';
                    }
                } catch (e) {
                    paymentMethodHtml = '<div class="detail-row"><span class="detail-value">Could not parse payment details</span></div>';
                }
            } else {
                paymentMethodHtml = '<div class="detail-row"><span class="detail-value">No payment method specified</span></div>';
            }

            $('#paymentMethodDetails').html(paymentMethodHtml);
        });
    });
</script>



@endpush

@endsection