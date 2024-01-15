<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\Create;
use App\Http\Controllers\Admin\User\UserView;
use App\Http\Controllers\Admin\User\UserLogin;
use App\Http\Controllers\Admin\Client\ClientCreate;
use App\Http\Controllers\Admin\Client\ClientView;

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

//Admin

//User Create
Route::get('/adminuser-create', [Create::class, 'create']);
Route::get('/adminuser-report/{role}', [Create::class, 'getreporting']);
Route::Post('/adminuser-create', [Create::class, 'store']);

//User View
Route::get('/adminuser-view', [UserView::class, 'create'])->name('adminuser-view');
Route::Post('/adminuser-view', [UserView::class, 'store'])->name('adminuser.view.store');


// Client Create
Route::get('/adminclient-create', [ClientCreate::class, 'create']);

Route::Post('/adminclient-create', [ClientCreate::class, 'store']);

// Client View
Route::get('/adminclient-view', [ClientView::class, 'create'])->name('adminclient-view');
Route::Post('/adminclient-view', [ClientView::class, 'store'])->name('adminclient.view.store');



// Admin User Login
Route::get('adminuser-login', [UserLogin::class, 'create'])->name('adminuser-login');








// Additional routes if needed...
