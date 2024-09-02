@extends('portal.layouts.master')
@section('content')
@section('title', $title)
<div class="container">
<div class="row gallery_render">
@foreach ($images as $image)
<div class="gallery_render_col col-md-3">
    <img src="{{ url('uploads/gallery/' . $image->image) }}" alt="">
    <p>{{ $image->title }}</p>
</div>
@endforeach
</div>
</div>
@endsection
