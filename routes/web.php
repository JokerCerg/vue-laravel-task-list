<?php

use Illuminate\Support\Facades\Route;

Route::get('/tasks', function(){
    return view('tasks');
});

Route::get('/', function() {
    return redirect('/tasks');
});