<?php

use App\Http\Controllers\PublicFormRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:10,1'])->post('/public-form-request', [PublicFormRequest::class, 'create']);


Route::middleware(['throttle:40,1'])->get('/bookings',function () {
    return BookingResource::collection(Booking::with('bookingDate')->get());
});
