<?php


use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;


use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


app()->make(Schedule::class)->command('logs:delete-old')->daily();
