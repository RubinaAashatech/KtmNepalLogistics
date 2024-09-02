@extends('layouts.master')

@section('content')

<h1>Customers</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Fullname</th>
            <th>Address</th>
            <th>Phone No</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @forelse($customers as $customer)
        <tr>
            <td>{{ $customer['fullname'] }}</td>
            <td>{{ $customer['address'] }}</td>
            <td>{{ $customer['phone_no'] }}</td>
            <td>{{ $customer['email'] }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4">No customers data found.</td>
        </tr>
    @endforelse
    
    </tbody>
</table>

@endsection
