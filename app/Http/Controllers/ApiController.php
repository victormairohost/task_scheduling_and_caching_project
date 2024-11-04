<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\ExternalApiService;

class ApiController extends Controller
{
    protected $apiService;

    public function __construct(ExternalApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getCachedData(): JsonResponse
    {
        // Fetch data from the service (cached data or fresh if expired)
        $data = $this->apiService->fetchApiData();

        // return response()->json([
        //     'data' => $data,
        //     'cached' => true, // You can indicate if this is cached data
        //     'expires_in' => 3600 // Expiration time in seconds
        // ]);
        return $data ? response()->json($data) : response()->json(['message' => 'No cached data available'], 404);
    }
}