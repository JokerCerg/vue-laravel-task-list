<?php

use Illuminate\Support\Facades\Route;

Route::get('/tasks', function(){
    return view('tasks');
});

Route::get('/', function() {
    return response()->json([
        'stuff' => phpinfo()
    ]);
});

// Route::get('/', function() {
//     return redirect('/tasks');
// });