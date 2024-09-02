@extends('layouts.master')

<!-- Main content -->
@section('content')
@include('includes.forms')
<div class="card card-primary">
    <div class="card-header">
        <h1 class="card-title">Update Client</h1>
        <a style="float: right;" href="/admin/clients"><button class="btn btn-success"><i class="fas fa-backward"></i>
                Back</button></a>
    </div>

    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.clients.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $client->id }}">
        <div class="card-body">
            <div class="form-group">
                <label for="title">name</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" value="{{ $client->name ?? '' }}" name="name" class="form-control" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="contact_number">Image</label><span style="color:red; font-size:large"> *</span>
                <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)" placeholder="Image" required>
            </div>
            <img src="{{ url('storage/'.$client->image) ?? '' }}" id="preview" style="max-width: 500px; max-height:500px" />


        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <script>
        const previewImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            };
        };
    </script>

</div>

@endsection