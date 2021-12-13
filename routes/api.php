<?php

use App\Http\Controllers\Productcontroller;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'Registercontroller@register');
Route::post('login', 'Registercontroller@login');
Route::middleware('auth:api')->group(function () {
    // Route::resource('products', Productcontroller::class);
    Route::post('product', 'Productcontroller@index');
    Route::post('productadd', 'Productcontroller@insert');
    Route::post('productupdate', 'Productcontroller@update');
    Route::get('productdelete', 'Productcontroller@delete');
});
