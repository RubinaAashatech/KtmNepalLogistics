@extends('layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 mb-4">Tracking Updates</h1>

    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>SN</th>
                        {{-- <th>Parcel ID</th> --}}
                        <th>Tracking Number</th>
                        <th>Carrier</th>
                        <th>Sending Date</th>
                        <th>Weight</th>
                        <th>Description</th>
                        <th>Estimated Delivery Date</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trackingUpdates as $parcelIndex => $parcel)
                        @foreach($parcel['tracking_updates'] as $updateIndex => $update)
                            <tr>
                                <td>{{ $updateIndex + 1 }}</td> 
                                {{-- <td>{{ $parcel['id'] }}</td> --}}
                                <td>{{ $parcel['tracking_number'] }}</td>
                                <td>{{ $parcel['carrier'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($parcel['sending_date'])->format('Y-m-d') }}</td>
                                <td>{{ $parcel['weight'] }}</td>
                                <td>{{ $parcel['description'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($parcel['estimated_delivery_date'])->format('Y-m-d') }}</td>
                                <td>{{ $update['status'] ?? 'N/A' }}</td>
                                <td>{{ $update['notes'] ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($update['created_at'])->format('Y-m-d') ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                        @if(!$loop->last)
                            <tr><td colspan="11" class="table-active"></td></tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">No tracking updates available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
