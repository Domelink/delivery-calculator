<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeliveryController;

Route::post('/calculate-delivery-fee', [DeliveryController::class, 'calculateDeliveryFee'])->name('delivery-fee');

