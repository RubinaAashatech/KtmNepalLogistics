@extends('portal.layouts.master')
@section('content')
    <div class="container mt-3">
        <div class="row contact_render">

            <div class="col-md-7">
                @include('portal.includes.quickcontact')

            </div>

            <div class="col-md-5">
                <iframe class="contact_maps"
                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d220.8191341125652!2d85.34241590352012!3d27.683114024043853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snp!4v1628585136581!5m2!1sen!2snp"
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

        </div>
    </div>
@endsection
