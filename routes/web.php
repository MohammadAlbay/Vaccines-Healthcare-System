<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("general.index");
});



include_once __DIR__ ."/auth.php";
