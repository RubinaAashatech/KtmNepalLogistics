@extends('layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.tables')
    @include('includes.modals')
    <hr>
    <div class="topbar" style="display: flex;">
        <a href="{{ route('admin.images.create') }}" style="text-decoration:none;width:auto;padding:5px;"><button
                type="button" class="btn btn-block btn-success btn-lg" style="width:auto;">Add Gallery Images <i
                    class="fas fa-file"></i>
            </button>
        </a>

    </div>
    <hr>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Images</h3>
        </div>
        <!-- ./card-header -->
        <div class="card-body">

            <hr>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($images as $image)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>{{ $image->id ?? '' }}</td>
                            <td>{{ $image->title ?? '' }}</td>
                            <td><img src="{{ url('uploads/gallery/' . $image->image) }}" style="max-width: 200px;max-height:200px;">
                            </td>
                            <td>
                                <a href="/admin/images/edit/{{ $image->id }}">
                                    <div style="display: flex; flex-direction:row;">
                                        <button type="button" class="btn btn-block btn-warning btn-sm"><i
                                                class="fas fa-edit"></i> Edit </button>
                                </a>
                                <button type="button" class="btn btn-block btn-danger btn-sm" data-toggle="modal"
                                    data-target="#modal-default" style="width:auto;"
                                    onclick="replaceLinkFunction(<?php echo $image->id; ?>)">Delete</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination m-1 float-right">
                <li class="page-item">{{ $images->links() ?? '' }}</li>
            </ul>
        </div>
    </div>
    <!-- Page specific script -->
    <script>
        function replaceLinkFunction(id) {
            document.getElementById('confirm_button').setAttribute("href", "/admin/images/delete/".concat(id));
        }
    </script>
@endsection
