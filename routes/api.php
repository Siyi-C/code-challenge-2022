<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\imageController;

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

// Route::apiResources('/api/title', [titleController::class, "title"]);

// Route::group(['prefix' => 'media'], function(){
//     Route::apiResource('gallery', imageController::class);
// });

Route::get('/all', [imageController::class, 'index']);
Route::get('/all/{id}', [imageController::class, 'show']);
Route::post('/add-image', [imageController::class, 'store']);
Route::put('/update/{id}', [imageController::class, 'edit']);
