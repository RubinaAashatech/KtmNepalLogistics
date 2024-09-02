@extends('layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.tables')
    @include('includes.modals')
    <hr>
    <hr>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Contact Requests</h3>
        </div>
        <!-- ./card-header -->
        <div class="card-body">

            <hr>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>{{ $contact->name ?? '' }}</td>
                            <td >{{ $contact->email ?? '' }}</td>
                            <td>{{ $contact->phone ?? '' }}</td>
                            <td>{{ $contact->message ?? '' }}</td>
                            <td>{{ $contact->created_at ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination m-1 float-right">
                <li class="page-item">{{ $contacts->links() ?? '' }}</li>
            </ul>
        </div>
    </div>
    <!-- Page specific script -->
@endsection
