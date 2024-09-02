@extends('portal.layouts.master')
@section('content')
@section('title', $title)

@foreach ($images as $image)
    <img src="{{ url('uploads/guide/' . $image->image) }}" alt="">
    <span>{{ $image->title }}</span>
@endforeach

@endsection