@extends('layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.tables')
    @include('includes.modals')
    <hr>
    <a href="{{ route('admin.roles.create') }}" style="text-decoration:none;"><button type="button"
            class="btn btn-block btn-success btn-lg" style="width:auto;">Add Role <i class="fas fa-user-plus"></i>

        </button>
    </a>
    <hr>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Roles</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">Name
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">Permissions
                                    </th>
                                    <th class="non-sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                        Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($role))
                                    @foreach ($role as $role)
                                        <tr class="odd">
                                            <td class="dtr-control sorting_1" tabindex="0">{{ $role->name }}</td>

                                            <td class="dtr-control sorting_1" tabindex="0">
                                                @foreach ($role->permissions as $permission)
                                                    <span class="badge badge-primary"
                                                        style="font-size: medium">{{ $permission->name }}</span>
                                                @endforeach
                                            </td>

                                            <td><a href="/admin/roles/edit/{{ $role->id }}">
                                                    <div style="display: flex; flex-direction:row;">
                                                        <button type="button"
                                                            class="btn btn-block btn-warning btn-sm">Edit</button>
                                                </a>
                                                <button type="button" class="btn btn-block btn-danger btn-sm"
                                                    data-toggle="modal" data-target="#modal-default" style="width:auto;"
                                                    onclick="replaceLinkFunction(<?php echo $role->id; ?>)">Delete</button>
                                            </td>
                    </div>

                    </tr>
                    @endforeach
                    @endif

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    </div>
    <!-- Page specific script -->
    <script>
        function replaceLinkFunction(id) {
            document.getElementById('confirm_button').setAttribute("href", "/admin/roles/delete/".concat(id));
        }
        $(function() {
            $.noConflict();
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    </script>
@endsection
