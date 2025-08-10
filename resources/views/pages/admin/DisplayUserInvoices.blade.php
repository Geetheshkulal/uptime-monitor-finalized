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
</style>
@endpush

<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 white-color">All Invoices</h1>
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
                            <th>Invoice No</th>
                            <th>User Name</th>
                            <th>User Phone</th>
                            <th>User email</th>
                            <th>Invoice Date</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{$invoice->billing_name}}</td>
                                <td>{{$invoice->user->phone}}</td>
                                <td>{{$invoice->user->email}}</td>
                                <td>{{ $invoice->invoice_date->format('d M Y')}}</td>
                                <td class="text-center">
                                    @if($invoice->file_path)
                                    <a href="{{ asset($invoice->file_path) }}" download> <i class="fas fa-file-download text-primary"></i></a>

                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">No invoices data available</td>
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
            "order": [[0, "asc"]],
            "language": {
            // "search": "", // Hides default "Search:" label
            "searchPlaceholder": "name, phone, invoice id"
        }
        });

      
    });
</script>
@endpush

@endsection