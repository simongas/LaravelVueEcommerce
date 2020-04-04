<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', 'HomeController@store')->where('any', '.*');
