
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
    /* .dataTables_length {
        text-align: left !important;
        margin-left: 2px;
        margin-bottom: 10px;
    } */
     
     .dataTables_filter{
            text-align: left !important;
    }
   
}

</style>
@endpush
    <!-- User Details Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">User Monitors</h6>
            <span class="badge badge-primary">{{ $user->monitors->count() }} Monitors</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" id="monitorsTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            @can('see.monitor.details')
                                <th>Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->monitors as $monitor)
                        <tr>
                            <td>{{ $monitor->name }}</td>
                            <td>{{ Str::limit($monitor->url, 30) }}</td>
                            <td>
                                @if($monitor->type === 'port')
                                    {{ $monitor->type }} ({{ $monitor->port }})
                                @else
                                    {{ $monitor->type }}
                                @endif
                            </td>
                            <td>
                                @if ($monitor->status === 'up')
                                    <span class="badge badge-success">Up</span>
                                @else
                                    <span class="badge badge-danger">Down</span>
                                @endif
                            </td>
                            <td data-order="{{ $monitor->created_at->timestamp }}">
                                {{ $monitor->created_at->format('M d, Y') }}
                            </td>
                            @can('see.monitor.details')
                                <td>
                                    <a href="{{ route('display.monitoring', ['id' => $monitor->id, 'type' => $monitor->type]) }}" 
                                    class="btn btn-sm btn-primary" title="View Monitor">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

$('#monitorsTable').DataTable({
            "responsive": true,
            "scrollX": false,
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            language: {
                "search": "Search:",
                // search: "_INPUT_",
                searchPlaceholder: "monitors...",
                // lengthMenu: "Show _MENU_ monitors per page",
                info: "Showing _START_ to _END_ of _TOTAL_ monitors",
                infoEmpty: "No monitors available",
                infoFiltered: "(filtered from _MAX_ total monitors)",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            },
            columnDefs: [
                { responsivePriority: 1, targets: 0 }, // Name column
                { responsivePriority: 2, targets: -1 }, // Action column if exists
                { orderable: false, targets: -1 } // Make action column not orderable
            ],
            order: [[4, "desc"]], // Default sort by Created Date descending
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
        });

    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
    
    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
</script>
    
@endpush