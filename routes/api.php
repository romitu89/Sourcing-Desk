<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\Create;
use App\Http\Controllers\Admin\User\UserView;
use App\Http\Controllers\Admin\User\UserLogin;
use App\Http\Controllers\Admin\Client\ClientCreate;
use App\Http\Controllers\Admin\Client\ClientView;
//------------------------------------------------------------
use App\Http\Controllers\Editor\User\EditorUserCreate;
use App\Http\Controllers\Editor\User\EditorUserView;
use App\Http\Controllers\Editor\User\EditorUserLogin;
//-------------------------------------------------------------
use App\Http\Controllers\AccountManager\Tracker\AMTrackerCreate;
use App\Http\Controllers\AccountManager\Tracker\AMTrackerView;
use App\Http\Controllers\AccountManager\TeamManagement\TeamCreate;
use App\Http\Controllers\AccountManager\TeamManagement\TeamView;
use App\Http\Controllers\AccountManager\Submission\AMApproval;
use App\Http\Controllers\AccountManager\Request\RequestCreate;
use App\Http\Controllers\AccountManager\Candidate\AMInterview;
use App\Http\Controllers\AccountManager\Candidate\Feedback;

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

// Admin Start

// Admin/User/Create
Route::get('/adminuser-create', [Create::class, 'create']);
Route::get('/adminuser-report/{role}', [Create::class, 'getreporting']);
Route::Post('/adminuser-create', [Create::class, 'store']);

// Admin/User/View
Route::get('/adminuser-view', [UserView::class, 'create']);
Route::Post('/adminuser-view', [UserView::class, 'store']);

//--------------------------------------------------------------------------

// Admin/Client/Create
Route::get('/adminclient-create', [ClientCreate::class, 'create']);
Route::Post('/adminclient-create', [ClientCreate::class, 'store']);

// Admin/Client/View
Route::get('/adminclient-view', [ClientView::class, 'create']);
Route::Post('/adminclient-view', [ClientView::class, 'store']);

//---------------------------------------------------------------------------

// Admin/User/Login
Route::get('adminuser-login', [UserLogin::class, 'create']);

//------------------------------------------------------------------------------


// Editor start-----

//User Create
Route::get('/editoruser-create', [EditorUserCreate::class, 'create']);
Route::get('/editoruser-report/{role}', [EditorUserCreate::class, 'getreporting']);
Route::Post('/editoruser-create', [EditorUserCreate::class, 'store']);

//User View
Route::get('/editoruser-view', [EditorUserView::class, 'create'])->name('editoruser-view');
Route::Post('/editoruser-view', [EditorUserView::class, 'store'])->name('editoruser.view.store');

 // User Login
 Route::get('editoruser-login', [EditorUserLogin::class, 'create'])->name('editoruser-login');
 Route::Post('/editoruser-login', [EditorUserLogin::class, 'store'])->name('editoruser.login.store');




// Account Manager Start

// AM/Tracker/Create
Route::get('/amtracker-create', [AMTrackerCreate::class, 'create']);
Route::Post('/amtracker-create', [AMTrackerCreate::class, 'store']);

// AM/Tracker/View
Route::get('/amtracker-view', [AMTrackerView::class, 'create']);
Route::Post('/amtracker-view', [AMTrackerView::class, 'store']);

//----------------------------------------------------------------------

// Team Management Create
Route::get('/amteam-create', [TeamCreate::class, 'create']);
Route::Post('/amteam-create', [TeamCreate::class, 'store']);

//Team View
Route::get('/amteam-view', [TeamView::class, 'create']);
Route::Post('/amteam-view', [TeamView::class, 'store']);

//-----------------------------------------------------------------------

// Submission Approval
Route::get('/submission-approve', [AMApproval::class, 'create']);
Route::patch('/amsubmission-update/{id}', [AMApproval::class, 'updateStatus']);
Route::post('/submission-approve', [AMApproval::class, 'store']);

//---------------------------------------------------------------------------

// Request Create
Route::get('/amrequest-create', [RequestCreate::class, 'create']);
Route::Post('/amrequest-create', [RequestCreate::class, 'store']);


// Interview
// Route::get('/candidate-interview', [AMInterview::class, 'create']);
// Route::get('/interview-search', [AMInterview::class, 'search']);
// Route::post('/candidate-interview', [AMInterview::class, 'store']);
// Route::post('/interview-update', [AMInterview::class, 'updateStatus']);

//--------------------------------------------------------------------------

// Candidate Feedback
Route::get('/candidate-feedback', [Feedback::class, 'create']);
Route::get('/search', [Feedback::class, 'search']);
Route::post('/candidate-feedback', [Feedback::class, 'store']);
Route::post('/candidate-update', [Feedback::class, 'updateStatus']);


// Additional routes if needed...
