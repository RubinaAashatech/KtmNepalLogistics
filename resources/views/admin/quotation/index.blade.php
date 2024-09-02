@extends('layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.tables')
    @include('includes.modals')
    <hr>
    <hr>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Quotation Requests</h3>
        </div>
        <!-- ./card-header -->
        <div class="card-body">

            <hr>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Commodity</th>
                        <th>Comments</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quotations as $quotation)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>{{ $quotation->company_name ?? '' }}</td>
                            <td>{{ $quotation->email ?? '' }}</td>
                            <td>{{ $quotation->phone ?? '' }}</td>
                            <td>{{ $quotation->commodity ?? '' }}</td>
                            <td>{{ $quotation->comments ?? '' }}</td>
                            <td>{{ $quotation->created_at ?? '' }}</td>
                            <td>
                                <a href="/admin/quotations/view/{{ $quotation->id }}">
                                    <div style="display: flex; flex-direction:row;">
                                        <button type="button" class="btn btn-block btn-warning btn-sm"><i
                                                class="fas fa-edit"></i> View </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination m-1 float-right">
                <li class="page-item">{{ $quotations->links() ?? '' }}</li>
            </ul>
        </div>
    </div>
    <!-- Page specific script -->
@endsection
