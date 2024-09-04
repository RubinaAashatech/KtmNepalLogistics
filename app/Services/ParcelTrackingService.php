<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ParcelTrackingService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = env('PARCEL_TRACKING_BASE_URL');
        $this->apiKey = env('PARCEL_TRACKING_API_KEY');
    }

    public function trackParcel($trackingNumber)
    {
        $url = "{$this->baseUrl}/track";
        Log::info("Tracking URL: $url");
        Log::info("Tracking Number: $trackingNumber");

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->post($url, [
            'tracking_number' => $trackingNumber,
        ]);
        Log::info("Response Status: " . $response->status());
        Log::info("Response Body: " . $response->body());

        return $response->json();
    }
    
    public function fetchData($endpoint)
    {
        $url = "{$this->baseUrl}/{$endpoint}";
        Log::info("Fetching data from URL: $url");

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept'        => 'application/json',
            ])->get($url);

            // Log::info("Raw API Response: " . $response->body());

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::warning("API request failed with status code: " . $response->status(), ['response_body' => $response->body()]);
                return ['error' => 'API request failed', 'status_code' => $response->status()];
            }
        } catch (\Exception $e) {
            Log::error("Error fetching data: " . $e->getMessage(), ['exception' => $e]);
            return ['error' => 'An error occurred', 'message' => $e->getMessage()];
        }
    }
}
