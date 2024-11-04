<?php

namespace App\Http\Controllers;

use Predis\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class TestRedisConnection extends Controller
{
    public function testRedisConnection()
    {

        return Redis::connection()->ping();
    }
}