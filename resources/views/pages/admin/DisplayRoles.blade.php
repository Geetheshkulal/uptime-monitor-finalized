@extends('dashboard')
@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<style>
    /* * {
        border-radius: 0 !important;
    } */

    @media (max-width: 430px) {
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
<div id="content-wrapper" class="d-flex flex-column">
<div class="page-content">
    <div class="container-fluid">
    <!-- Page Heading with proper margins -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 white-color">Roles Management</h1>
        @can('add.role')
            <a href="{{ route('add.role') }}" class="d-sm-inline-block btn btn-primary shadow-sm mt-2 mt-md-0">
                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add Role
            </a>
        @endcan
    </div>

    <!-- Content Row with container margins -->

            <div class="card shadow mb-4">
                <div class="card-body px-4 py-4">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="rolesTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Role Name</th>
                                    @can('edit.role.permissions')
                                        <th width="25%" class="text-center">Permissions</th>
                                    @endcan

                                    @canany(['edit.role','delete.role'])
                                        <th width="20%" class="text-center">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $key => $role)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                            <span class="badge badge-primary py-1 px-2">{{ $role->name }}</span>
                                    </td>
                                    @can('edit.role.permissions')
                                        <td class="text-center">
                                            <a href="{{ route('edit.role.permissions',$role->id) }}" class="btn btn-sm btn-success px-3 py-1">
                                                <i class="fas fa-key mr-1"></i> Manage
                                            </a>
                                        </td>
                                    @endcan
                                    @if(in_array($role->name,['support','admin','user']))
                                        <td class="text-center">System Role</td>
                                    @else
                                        @canany(['edit.role','delete.role'])
                                            <td class="text-center">
                                                @can('edit.role')
                                                    <a href="{{ route('edit.role',$role->id) }}" class="ml-2">
                                                        <i class="fas fa-edit" style="color: #2653d4; cursor: pointer;"></i>
                                                    </a>
                                                @endcan

                                                @can('delete.role')
                                                    {{-- <a href="{{ route('delete.role',$role->id) }}" class="btn btn-sm btn-danger px-3 py-1" onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a> --}}

                                                    <a href="#" data-toggle="modal" data-target="#roleDeleteModal{{ $role->id }}" class="ml-2">
                                                        <i class="fas fa-trash" style="color: #e74a3b; cursor: pointer;"></i>
                                                    </a>
                                                @endcan
                                        </td>
                                        @endcanany
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
  

</div>
</div>


<!-- Delete Coupon Modal -->

@foreach($roles as $role)
<div class="modal fade" id="roleDeleteModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="roleDeleteModalLabel{{ $role->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="POST" action="{{ route('delete.role',$role->id) }}">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title" id="roleDeleteModalLabel{{ $role->id }}">Delete Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    
            <div class="modal-body">
                <p>Are you sure you want to delete this Role : <strong>{{ $role->name }}</strong> ? </p>
                <p>This action cannot be undone.</p>
            </div>
    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete Role</button>
            </div>
        </form>
    </div>
</div>
@endforeach


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#rolesTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "order": [[0, "asc"]],
            "columnDefs": [
                { "orderable": false, "targets": [2, 3] },
                { "searchable": false, "targets": [2] }
            ]
        });
    });

    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
    
    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
</script>
@endpush
@endsection