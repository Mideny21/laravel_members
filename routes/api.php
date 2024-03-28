<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['cors'])->group(function () {


    Route::apiResource('/member', MembersController::class);
    Route::apiResource('/customer', CustomerController::class);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/tasks', TasksController::class);
    Route::post('/logout', [AuthController::class, 'logout']);

});
