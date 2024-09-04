@extends('layouts.master')

@section('content')

    <h1>Parcels</h1>
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SN</th> 
                <th>Tracking Number</th>
                <th>Customer</th>
                <th>Receiver</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Street Address</th>
                <th>Postal Code</th>
                <th>Carrier</th>
                <th>Sending Date</th>
                <th>Weight</th>
                <th>Description</th>
                <th>Estimated Delivery Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($parcels as $index =>  $parcel)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $parcel['tracking_number'] ?? 'N/A' }}</td>
                    <td>{{ $parcel['customer']['fullname'] ?? 'N/A' }}</td>
                    <td>{{ $parcel['receiver']['fullname'] ?? 'N/A' }}</td>
                    <td>{{ $parcel['receiver']['country'] ?? 'N/A' }}</td>
                    <td>{{ $parcel['receiver']['state'] ?? 'N/A' }}</td>
                    <td>{{ $parcel['receiver']['city'] ?? 'N/A' }}</td>
                    <td>{{ $parcel['receiver']['street_address'] ?? 'N/A' }}</td>
                    <td>{{ $parcel['receiver']['postal_code'] ?? 'N/A' }}</td>
                    <td>{{ $parcel['carrier'] ?? 'N/A' }}</td>
                    <td>{{ isset($parcel['sending_date']) ? \Carbon\Carbon::parse($parcel['sending_date'])->format('Y-m-d') : 'N/A' }}</td>
                    <td>{{ $parcel['weight'] ?? 'N/A' }}</td>
                    <td>{{ $parcel['description'] ?? 'N/A' }}</td>
                    <td>{{ isset($parcel['estimated_delivery_date']) ? \Carbon\Carbon::parse($parcel['estimated_delivery_date'])->format('Y-m-d') : 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="13">No parcels found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
