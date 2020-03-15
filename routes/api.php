<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Http\Controllers\TaskController;

Route::apiResource('/tasks', 'TaskController');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


