@php
$sitesetting = App\Models\SiteSetting::first();
@endphp
@extends('portal.layouts.master',['sitesetting'=>$sitesetting])

@section('content')


@include('portal.includes.coverImage')



@include('portal.includes.home')





@include('portal.includes.client')


@endsection