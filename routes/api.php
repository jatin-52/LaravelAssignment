<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ScoreBoardUserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('score-board-user', [ScoreBoardUserController::class, 'index']);
Route::post('score-board-user/store', [ScoreBoardUserController::class, 'store']);
Route::delete('score-board-user/destroy/{id}', [ScoreBoardUserController::class, 'destroy']);
Route::put('score-board-user/updateUserPoint', [ScoreBoardUserController::class, 'updateUserPoint']);
