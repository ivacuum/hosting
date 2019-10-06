<?php

use App\Http\Controllers;

Route::get('about', Controllers\AboutController::class);

Route::get('.well-known/change-password', Controllers\WellKnownChangePasswordController::class);
