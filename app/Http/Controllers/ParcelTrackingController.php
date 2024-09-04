<?php
namespace App\Http\Controllers;

use App\Services\ParcelTrackingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ParcelTrackingController extends Controller
{
    protected $parcelTrackingService;

    public function __construct(ParcelTrackingService $parcelTrackingService)
    {
        $this->parcelTrackingService = $parcelTrackingService;
    }

    public function track(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string',
        ]);

        $trackingNumber = $request->input('tracking_number');

        try {
            $trackingInfo = $this->parcelTrackingService->trackParcel($trackingNumber);
            return response()->json(['trackingInfo' => $trackingInfo]);
        } catch (\Exception $e) {
            Log::error('Tracking Error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while tracking the parcel.'], 500);
        }
    }

    public function showTrackingForm()
    {
        return view('portal.includes.tracking');
    }

    public function fetchCustomers()
    {
        try {
            $response = $this->parcelTrackingService->fetchData('customers');
            if (is_array($response) && !empty($response)) {
                $customers = $response;
            } else {
                Log::warning('No customers data found.');
                $customers = [];
            }
            
            return view('logistics.customers.index', ['customers' => $customers]);
        } catch (\Exception $e) {
            Log::error('Error fetching customers: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching customers.'], 500);
        }
    }
    

    public function fetchReceivers()
    {
        try {
            $response = $this->parcelTrackingService->fetchData('receivers');
            if (is_array($response) && !empty($response)) {
                $receivers = $response; 
                return view('logistics.receivers.index', ['receivers' => $receivers]);
            } else {
                Log::warning('No receivers data found.');
                return view('logistics.receivers.index', ['receivers' => []]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching receivers: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching receivers.'], 500);
        }
    }

 
    public function fetchParcels()
    {
        try {
            $response = $this->parcelTrackingService->fetchData('parcels');
            Log::info('Parcels API Response: ' . print_r($response, true));
    
            if (is_array($response) && !empty($response)) {
                $customerIds = array_column($response, 'customer_id');
                $receiverIds = array_column($response, 'receiver_id');
                
                $customers = $this->parcelTrackingService->fetchData('customers');
                $receivers = $this->parcelTrackingService->fetchData('receivers'); 
    
                $customerIndex = [];
                foreach ($customers as $customer) {
                    $customerIndex[$customer['id']] = $customer;
                }
    
                $receiverIndex = [];
                foreach ($receivers as $receiver) {
                    $receiverIndex[$receiver['id']] = $receiver;
                }

                foreach ($response as &$parcel) {
                    $parcel['customer'] = $customerIndex[$parcel['customer_id']] ?? [];
                    $parcel['receiver'] = $receiverIndex[$parcel['receiver_id']] ?? [];
                }
    
                return view('logistics.parcels.index', ['parcels' => $response]);
            } else {
                Log::warning('No parcels data found.');
                return view('logistics.parcels.index', ['parcels' => []]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching parcels: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching parcels.'], 500);
        }
    }
    
        public function fetchTrackingUpdates()
    {
        try {
            $trackingUpdates = $this->parcelTrackingService->fetchData('tracking-updates');
            if (is_array($trackingUpdates) && !empty($trackingUpdates)) {
                return view('logistics.tracking-updates.index', ['trackingUpdates' => $trackingUpdates]);
            } else {
                return view('logistics.tracking-updates.index', ['trackingUpdates' => []]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching tracking updates.'], 500);
        }
    }

    public function fetchParcelHistories()
    {
        try {
            $parcelHistories = $this->parcelTrackingService->fetchData('parcel-histories');
            $parcels = $this->parcelTrackingService->fetchData('parcels');

            $parcelIndex = [];
            foreach ($parcels as $parcel) {
                $parcelIndex[$parcel['id']] = $parcel;
            }
            foreach ($parcelHistories as &$history) {
                if (isset($history['latest_tracking_update'])) {
                    $parcelId = $history['latest_tracking_update']['parcel_id'];
                    $history['parcel'] = $parcelIndex[$parcelId] ?? [];
                } else {
                    $history['parcel'] = [];
                }
            }

            return view('logistics.parcel-histories.index', ['parcelHistories' => $parcelHistories]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching parcel histories.'], 500);
        }
    }

}    
