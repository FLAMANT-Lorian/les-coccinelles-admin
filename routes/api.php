<?php

use App\Http\Controllers\PublicFormRequest;
use Illuminate\Support\Facades\Route;

Route::post('/public-form-request', [PublicFormRequest::class, 'create']);
