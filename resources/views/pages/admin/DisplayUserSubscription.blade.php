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

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 white-color">All Subscriptions</h1>
    </div>
    <!-- Content Row -->
    <div class="card shadow mb-4">
     
        <!-- Card Body -->
        <div class="card-body px-4 py-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Plan Name</th>
                            <th>Subs. ID</th>
                            <th>Maximum Amt</th>
                            <th>Recurring Amt</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subscriptions as $subscription)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subscription->plan_name }}</td>
                                <td>{{$subscription->cashfree_subscription_id}}</td>
                                <td>{{ $subscription->authorization_amount}}</td>
                                <td>{{ $subscription->plan_recurring_amount }}</td>
                                <td>{{ $subscription->user->name ?? 'N/A' }}<br>
                                <td>{{$subscription->user->phone}}</td>
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
                                <td>{{$subscription->created_at->format('d M Y')}}</td>
                                <td>

                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('admin.userSubscriptions.show', $subscription->cashfree_subscription_id) }}" class="text-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">No subscriptions data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Load Tippy.js after Bootstrap -->
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>

{{-- <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script> --}}

<script>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

    $(document).ready(function () {

        $('#dataTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            responsive: true,
            scrollX: false,
            "order": [[0, "asc"]],
            "language": {
            // "search": "", // Hides default "Search:" label
            "searchPlaceholder": "name, phone, subscription id"
        }
        });

      
    });
</script>
@endpush

@endsection