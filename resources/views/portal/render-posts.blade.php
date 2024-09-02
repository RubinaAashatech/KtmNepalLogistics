@extends('portal.layouts.master')
@section('content')
@section('title', $title)

<div class="container post_render">

    <div class="row">
        <img src="{{ url('uploads/post/'.$post->image) }}">

        <div class="col-md-9">

<h2>{{ $post->title }}</h2>

<p>{{ $post->description }}</p>

<section>{!! $post->content !!}</section>
        </div>

        <div class="col-md-3">
            @include('portal.includes.news')
            @include('portal.includes.quickcontact')
        </div>
    </div>
</div>
@endsection