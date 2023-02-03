<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Router;

use App\Http\Controllers\Admin\HomeController;

Route::get('', [HomeController::class, 'index']);
