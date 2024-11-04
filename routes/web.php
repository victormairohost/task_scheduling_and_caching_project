<?php

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\TestRedisConnection;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-redis', [TestRedisConnection::class, 'testRedisConnection']);

// Route::get('/test-redis', function () {
//     return Redis::connection()->ping();
// });

Route::get('/cached-data', [ApiController::class, 'getCachedData']);