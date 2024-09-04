@extends('layouts.master')

@section('content')

<h1>Receivers</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>SN</th> 
            <th>Fullname</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Street Address</th>
            <th>Postal Code</th>
            <th>Phone No</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @forelse($receivers as $index => $receiver)
            <tr>
                <td>{{ $index + 1 }}</td> 
                <td>{{ $receiver['fullname'] }}</td>
                <td>{{ $receiver['country'] }}</td>
                <td>{{ $receiver['state'] }}</td>
                <td>{{ $receiver['city'] }}</td>
                <td>{{ $receiver['street_address'] }}</td>
                <td>{{ $receiver['postal_code'] }}</td>
                <td>{{ $receiver['phone_no'] }}</td>
                <td>{{ $receiver['email'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No receivers data found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
