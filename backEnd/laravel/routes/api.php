<?php

use App\Http\Controllers\EmployeeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/index', [EmployeeController::class, 'index']);
Route::post('/save', [EmployeeController::class, 'store']);
Route::get('/edit/{id}', [EmployeeController::class, 'edit']);
Route::put('/update/{id}', [EmployeeController::class, 'update']);
Route::delete('/delete/{id}', [EmployeeController::class, 'delete']);