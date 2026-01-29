<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

// Auth Routes moved to api.php for Token Based Auth

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
