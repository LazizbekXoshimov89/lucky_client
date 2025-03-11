<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post("user/login", [UserController::class, "login"]);
Route::middleware('auth:sanctum')->group(function () {
Route::post("gift/importFromExcel", [GiftController::class, "ImportFromExcel"]);
Route::post("ticket/importFromExcel", [TicketController::class, "ImportFromExcel"]);
Route::get("bakalWin", [GameController::class, "winBakal"]);
Route::get("win", [GameController::class, "secondUsul"]);
});

