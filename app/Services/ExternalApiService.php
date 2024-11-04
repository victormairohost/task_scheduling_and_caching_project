<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ExternalApiService
{
    protected $apiUrl = 'https://jsonplaceholder.typicode.com/posts';

    public function fetchApiData()
    {
        return Cache::remember('api_data', 3600, function () {
            // Make the API request
            $response = Http::get($this->apiUrl);
            $data = $response->json();

            // Log the API request only when fetching fresh data
            DB::table('logs')->insert([
                'request_url' => $this->apiUrl,
                'response_status' => $response->status(),
                'response_data' => json_encode($data),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return $data;
        });
    }
}