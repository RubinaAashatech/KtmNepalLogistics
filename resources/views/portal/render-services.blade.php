@extends('portal.layouts.master')

@section('content')
@section('title', $title)
<div class="container service_render">

    <div class="row">
<img src="{{ url('uploads/service/'.$service->image) }}">

        <div class="col-md-9">

<h2>{{ $service->title }}</h2>

<p>{{ $service->description }}</p>

<section>{!! $service->content !!}</section>
        </div>

        <div class="col-md-3">
            @include('portal.includes.news')
        </div>
    </div>
</div>
@endsection
