@extends('layouts.master')

@section('content')
    <h1>Parcel History</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Parcel ID</th>
                <th>Tracking Number</th>
                <th>Carrier</th>
                <th>Current Status</th>
                <th>Current Location</th>
                <th>Description</th>
                <th>Last Update</th>
            </tr>
        </thead>
        <tbody>
             @foreach($parcelhistories as $history)
                <tr>
                    <td>{{ $history['parcel']['parcel_id'] ?? 'N/A' }}</td>
                    <td>{{ $history['parcel']['tracking_number'] ?? 'N/A' }}</td>
                    <td>{{ $history['parcel']['carrier'] ?? 'N/A' }}</td>
                    <td>{{ $history['current_status'] ?? 'N/A' }}</td>
                    <td>{{ $history['current_location'] ?? 'N/A' }}</td>
                    <td>{{ $history['parcel']['description'] ?? 'N/A' }}</td>
                    <td>{{ isset($history['last_update']) ? \Carbon\Carbon::parse($history['last_update'])->format('Y-m-d H:i:s') : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
