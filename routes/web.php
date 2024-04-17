<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;

 
Route::post('/api/v1/short-urls', [ShortURLController::class, 'create']);

Route::post('/check-string', [StringController::class, 'crecheckStringate']);

