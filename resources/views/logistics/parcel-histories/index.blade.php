@extends('layouts.master')

@section('content')
    <h1>Parcel History</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SN</th> 
                {{-- <th>Parcel ID</th> --}}
                <th>Tracking Number</th>
                <th>Carrier</th>
                <th>Current Status</th>
                <th>Current Location</th>
                <th>Description</th>
                <th>Last Update</th>
            </tr>
        </thead>
        <tbody>
             @foreach($parcelHistories as $index =>  $history)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    {{-- <td>{{ $history['id'] ?? 'N/A' }}</td> --}}
                    <td>{{ $history['tracking_number'] ?? 'N/A' }}</td>
                    <td>{{ $history['carrier'] ?? 'N/A' }}</td>
                    <td>{{ $history['latest_tracking_update']['status'] ?? 'N/A' }}</td>
                    <td>{{ $history['latest_tracking_update']['location'] ?? 'N/A' }}</td>
                    <td>{{ $history['description'] ?? 'N/A' }}</td>
                    <td>{{ isset($history['latest_tracking_update']['created_at']) ? \Carbon\Carbon::parse($history['latest_tracking_update']['created_at'])->format('Y-m-d') : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
