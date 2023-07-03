<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TechnologyController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/projects', [ProjectController::class, 'index']);

Route::get('/projects/{slug}', [ProjectController::class, 'show']);

Route::get('/types', [TypeController::class, 'index']);

Route::get('/technologies', [TechnologyController::class, 'index']);


