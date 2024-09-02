@extends('layouts.master')

<!-- Main content -->
@section('content')
    @include('includes.forms')
    @include('includes.modals')

    <div class="card card-primary">
        <div class="card-header">
            <h1 class="card-title">Update Site Settings</h1>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.sitesettings.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">App Name</label>
                        <input type="text" name="site_name" value="{{ $sitesetting->site_name ?? '' }}" class="form-control"
                             placeholder="Website Name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">App Name</label>
                        <input type="text" name="company_name" value="{{ $sitesetting->company_name ?? '' }}" class="form-control"
                             placeholder="Company Name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" name="location" value="{{ $sitesetting->location ?? '' }}" class="form-control"
                             placeholder="Address" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" value="{{ $sitesetting->email ?? '' }}" class="form-control"
                             placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone Number</label>
                        <input type="number" name="contact_number" value="{{ $sitesetting->contact_number ?? '' }}" class="form-control"
                             placeholder="Phone Number" required>
                    </div>

                    <div class="form-group">
                        <label for="contact_number">Logo</label><span style="color:red; font-size:large"> *</span>
                        <input type="file" name="logo" class="form-control"  onchange="previewImage1(event)" placeholder="Logo" required>
                    </div>
                    <img id="preview1" src="{{ url('storage/'.$sitesetting->logo) }}" style="max-width: 500px; max-height:500px" />

                    <div class="form-group">
                        <label for="contact_number">Cover Image</label><span style="color:red; font-size:large"> *</span>
                        <input type="file" name="cover_image" class="form-control"  onchange="previewImage2(event)" placeholder="Cover Image" required>
                    </div>
                    <img id="preview2" src="{{ url('storage/'.$sitesetting->cover_image) }}" style="max-width: 500px; max-height:500px" />

                    <div class="form-group">
                        <label for="contact_number">Introduction Image</label><span style="color:red; font-size:large"> *</span>
                        <input type="file" name="introduction_image" class="form-control"  onchange="previewImage3(event)" placeholder="Introduction Image" required>
                    </div>
                    <img id="preview3" src="{{ url('storage/'.$sitesetting->introduction_image) }}" style="max-width: 500px; max-height:500px" />
                    
                    <div class="form-group">
                        <label for="">Introduction Text</label>
                        <textarea name="introduction_text" class="form-control"  cols="30" rows="10">{{ $sitesetting->introduction_text ?? 'none' }}</textarea>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Apply</button>
            </div>
        </form>
        <script>
            const previewImage1 = e => {
                const reader = new FileReader();
                reader.readAsDataURL(e.target.files[0]);
                reader.onload = () => {
                    const preview = document.getElementById('preview1');
                    preview.src = reader.result;
                };
            };
            const previewImage2 = e => {
                const reader = new FileReader();
                reader.readAsDataURL(e.target.files[0]);
                reader.onload = () => {
                    const preview = document.getElementById('preview2');
                    preview.src = reader.result;
                };
            };
            const previewImage3 = e => {
                const reader = new FileReader();
                reader.readAsDataURL(e.target.files[0]);
                reader.onload = () => {
                    const preview = document.getElementById('preview3');
                    preview.src = reader.result;
                };
            };
        </script>
    </div>
@endsection
