@extends('layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.tables')
    @include('includes.modals')
    <hr>
    <hr>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Email Subscriptions</h3>
        </div>
        <!-- ./card-header -->
        <div class="card-body">

            <hr>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $subscription)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>{{ $subscription->id ?? '' }}</td>
                            <td >{{ $subscription->email ?? '' }}</td>
                            <td>{{ $subscription->created_at ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination m-1 float-right">
                <li class="page-item">{{ $subscriptions->links() ?? '' }}</li>
            </ul>
        </div>
    </div>
    <!-- Page specific script -->
@endsection
