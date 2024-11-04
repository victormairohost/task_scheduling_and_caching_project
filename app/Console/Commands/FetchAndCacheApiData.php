<?php

namespace App\Console\Commands;

use App\Models\Log;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FetchAndCacheApiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-and-cache-api-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch data from an external API
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        // Cache the response in Redis, with expiration of one hour
        Cache::put('api_data', $response->json(), now()->addHour());

        // Log the request and response data in the database
        Log::create([
            'request_url' => 'https://jsonplaceholder.typicode.com/posts',
            'response_data' => $response->json(),
        ]);

        $this->info('API data fetched and cached successfully.');
    }
}