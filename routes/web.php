<?php

use App\Events\Hello;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/broadcast', function () {
    broadcast(new Hello());
});

