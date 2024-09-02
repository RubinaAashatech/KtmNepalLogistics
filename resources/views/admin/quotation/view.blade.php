@extends('layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    <div class="card card-primary">
        <div class="card-header">
            <h1 class="card-title">Quotation Details</h1>
        </div>

        <form id="quickForm" novalidate="novalidate" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" value="{{ $quotation->company_name ?? '' }}" name="title" class="form-control"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="">Existing client</label>
                    <input type="text" value="{{ $quotation->existing_client == 1 ? 'Existing' : 'New Client' ?? '' }}"
                        name="title" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="">Contact Name</label>
                    <input type="text" value="{{ $quotation->contact_name ?? '' }}" name="title" class="form-control"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" value="{{ $quotation->phone ?? '' }}" name="title" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="">Fax Number</label>
                    <input type="text" value="{{ $quotation->fax_number ?? '' }}" name="title" class="form-control"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" value="{{ $quotation->email ?? '' }}" name="title" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="">Notification type</label>
                    <input type="text" value="{{ $quotation->notification_type ?? '' }}" name="title" class="form-control"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="">Commodity</label>
                    <input type="text" value="{{ $quotation->commodity ?? '' }}" name="title" class="form-control"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="">Origin Place</label>
                    <input type="text" value="{{ $quotation->origin_place ?? '' }}" name="title" class="form-control"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="">Origin Port</label>
                    <input type="text" value="{{ $quotation->origin_port ?? '' }}" name="title" class="form-control"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="">Destination</label>
                    <input type="text" value="{{ $quotation->destination ?? '' }}" name="title" class="form-control"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="">Mode</label>
                    <input type="text" value="{{ $quotation->mode ?? '' }}" name="title" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="">Inco Terms</label>
                    <input type="text" value="{{ $quotation->inco_terms ?? '' }}" name="title" class="form-control"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="">Weight in Kgs</label>
                    <input type="text" value="{{ $quotation->weight_kg ?? '' }}" name="title" class="form-control"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="">Weight in cubic meters</label>
                    <input type="text" value="{{ $quotation->weight_cubic_meter ?? '' }}" name="title"
                        class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="">Size/Type</label>
                    <input type="text" value="{{ $quotation->size ?? '' }}" name="title" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="">Comments</label>
                    <textarea name="" class="form-control" disabled>{{ $quotation->comments ?? '' }}</textarea>
                </div>



            </div>
        </form>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="/admin/quotations"><button class="btn btn-success"><i class="fas fa-backward"></i>
                    Back</button></a>
        </div>


    </div>

@endsection
