@extends('layouts.master')

@section('content')

<h1>Tracking Updates</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tracking Number</th>
            <th>Receiver Name</th>
            <th>Status</th>
            <th>Location</th>
            <th>Description</th>
            <th>Notes</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($trackingupdates as $trackingupdate)
            <tr>
                <td>{{ $trackingupdate['id'] ?? 'N/A' }}</td>
                <td>{{ $trackingupdate['tracking_number'] ?? 'N/A' }}</td>
                <td>{{ $trackingupdate['parcel']['receiver']['fullname'] ?? 'N/A' }}</td>
                <td>{{ $trackingupdate['status'] ?? 'N/A' }}</td>
                <td>{{ $trackingupdate['location'] ?? 'N/A' }}</td>
                <td>{{ $trackingupdate['description'] ?? 'N/A' }}</td>
                <td>{{ $trackingupdate['notes'] ?? 'N/A' }}</td>
                <td>{{ $trackingupdate['created_at'] ?? 'N/A' }}</td>
                <td>{{ $trackingupdate['updated_at'] ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>    
</table>

@endsection
