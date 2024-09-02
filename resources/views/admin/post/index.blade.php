@extends('layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.tables')
    @include('includes.modals')
    <hr>
    <div class="topbar" style="display: flex;">
        <a href="{{ route('admin.posts.create') }}" style="text-decoration:none;width:auto;padding:5px;"><button
                type="button" class="btn btn-block btn-success btn-lg" style="width:auto;">Add Posts <i
                    class="fas fa-file"></i>
            </button>
        </a>

    </div>
    <hr>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Posts</h3>
        </div>
        <!-- ./card-header -->
        <div class="card-body">

            <hr>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>{{ $post->title ?? '' }}</td>
                            <td >{{ $post->type ?? '' }}</td>
                            <td>
                                    <a href="/admin/posts/edit/{{ $post->id }}">
                                        <div style="display: flex; flex-direction:row;">
                                            <button type="button" class="btn btn-block btn-warning btn-sm"><i
                                                    class="fas fa-edit"></i> Edit </button>
                                    </a>
                                    <button type="button" class="btn btn-block btn-danger btn-sm" data-toggle="modal"
                                        data-target="#modal-default" style="width:auto;"
                                        onclick="replaceLinkFunction(<?php echo $post->id; ?>)">Delete</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination m-1 float-right">
                <li class="page-item">{{ $posts->links() ?? '' }}</li>
            </ul>
        </div>
    </div>
    <!-- Page specific script -->
    <script>
        function replaceLinkFunction(id) {
            document.getElementById('confirm_button').setAttribute("href", "/admin/posts/delete/".concat(id));
        }
    </script>
@endsection
