<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Produk\OrderController;

Route::post('/midtrans/callback', [OrderController::class, 'callback']);