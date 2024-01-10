<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\Create;

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



// Route for creating a user (POST request)

  //User Create
  Route::get('/adminuser-create', [Create::class, 'create']);
  Route::get('/adminuser-report/{role}', [Create::class, 'getreporting']);
  Route::Post('/adminuser-create', [Create::class, 'store']);

// Additional routes if needed...
