<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
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

Route::group(['prefix' => 'members'], function () {
    Route::get('/', [MemberController::class, 'index']);
    Route::post('/{id}/booking', [MemberController::class, 'booked']);
    Route::post('/{id}/return', [MemberController::class, 'returned']);
});

Route::get('/books', [BookController::class, 'index']);
