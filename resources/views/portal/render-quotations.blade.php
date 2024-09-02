@extends('portal.layouts.master')
@section('content')
<div class="container">
    <h3>Request Quotations</h3>
    <div class="card card-primary">



        <form id="quickForm" action="{{ route('admin.quotations.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" name="company_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Existing client</label>
                    <select name="existing_client" id="" class="form-control" required>
                        <option value="no" disabled>--Select Client Type--</option>
                        <option value="1">Existing Client</option>
                        <option value="0">New Client</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Contact Name</label>
                    <input type="text" name="contact_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="number" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Fax Number</label>
                    <input type="number" name="fax_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Notification type</label>
                    <select name="notification_type" class="form-control" required>
                        <option value="none" disabled>--Select Notification Type--</option>
                        <option value="phone">Phone</option>
                        <option value="email">Email</option>
                        <option value="fax">Fax</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Commodity</label>
                    <input type="text" name="commodity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Origin Place</label>
                    <input type="text" name="origin_place" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Origin Port</label>
                    <input type="text" name="origin_port" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Destination</label>
                    <input type="text" name="destination" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Mode</label>
                    <select name="mode" class="form-control" required>
                        <option value="none" disabled>--Select Mode--</option>
                        <option value="Air Freight">Air Freight</option>
                        <option value="Sea Freight FCL">Sea Freight FCL</option>
                        <option value="Sea Freight LCL">Sea Freight LCL</option>
                        <option value="Custom clearance">Custom clearance</option>
                        <option value="Warehousing and Distribution">Warehousing and Distribution</option>
                        <option value="Import">Import</option>
                        <option value="Export">Export</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Inco Terms</label>
                    <select name="inco_terms" class="form-control" required>
                        <option value="none" disabled>--Select Inco Terms--</option>
                        <option value="FOB">FOB</option>
                        <option value="Ex-works">Ex-works</option>
                        <option value="CIF">CIF</option>
                        <option value="CNF">CNF</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Weight in Kgs</label>
                    <input type="number" name="weight_kg" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Weight in cubic meters</label>
                    <input type="number" name="weight_cubic_meter" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Size/Type</label>
                    <input type="text" name="size" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Comments</label>
                    <textarea name="comments" class="form-control" required></textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <input type="submit" name="Submit">
            </div>
        </form>
    </div>
</div>

@endsection
