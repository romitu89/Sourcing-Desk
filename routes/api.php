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
use App\Http\Controllers\Editor\Client\EditorClientCreate;
use App\Http\Controllers\Editor\Client\EditorClientView;
//-------------------------------------------------------------
use App\Http\Controllers\AccountManager\Tracker\AMTrackerCreate;
use App\Http\Controllers\AccountManager\Tracker\AMTrackerView;
use App\Http\Controllers\AccountManager\TeamManagement\TeamCreate;
use App\Http\Controllers\AccountManager\TeamManagement\TeamView;
use App\Http\Controllers\AccountManager\Submission\AMApproval;
use App\Http\Controllers\AccountManager\Request\RequestCreate;
use App\Http\Controllers\AccountManager\Candidate\AMInterview;
use App\Http\Controllers\AccountManager\Candidate\Feedback;
//----------------------------------------------------------------

use App\Http\Controllers\TeamLead\Tracker\TLTrackerCreate;
use App\Http\Controllers\TeamLead\Tracker\TLTrackerView;
use App\Http\Controllers\TeamLead\TeamManagement\TLTeamCreate;
use App\Http\Controllers\TeamLead\TeamManagement\TLTeamView;
use App\Http\Controllers\TeamLead\Submission\TLApproval;
use App\Http\Controllers\TeamLead\Submission\TLRecruiterSubmission;
use App\Http\Controllers\TeamLead\Submission\TLRequirement;

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
Route::get('/editoruser-view', [EditorUserView::class, 'create']);
Route::Post('/editoruser-view', [EditorUserView::class, 'store']);

// User Login
Route::get('editoruser-login', [EditorUserLogin::class, 'create']);
Route::Post('/editoruser-login', [EditorUserLogin::class, 'store']);

//--------------------------------------------------------------------------

// Client Create

Route::get('/editorclient-create', [EditorClientCreate::class, 'create']);
Route::Post('/editorclient-create', [EditorClientCreate::class, 'store']);

// Client View
Route::get('/editorclient-view', [EditorClientView::class, 'create']);
Route::Post('/editorclient-view', [EditorClientView::class, 'store']);




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


//------------------------------------------------------------------------------
//------------------------------------------------------------------------------

// Team Lead Start

// Tracker Create
Route::get('/tltracker-create', [TLTrackerCreate::class, 'create']);
Route::Post('/tltracker-create', [TLTrackerCreate::class, 'store']);

//Tracker View
Route::get('/tltracker-view', [TLTrackerView::class, 'create']);
Route::Post('/tltracker-view', [TLTrackerView::class, 'store']);

// Team Management Create
Route::get('/tlteam-create', [TLTeamCreate::class, 'create']);
Route::Post('/tlteam-create', [TLTeamCreate::class, 'store']);

//Team View
Route::get('/tlteam-view', [TLTeamView::class, 'create']);
Route::Post('/tlteam-view', [TLTeamView::class, 'store']);


// Submission Approval
Route::get('/tlsubmission-approve', [TLApproval::class, 'create']);
Route::patch('/tlsubmission-update/{id}', [TLApproval::class, 'updateStatus']);
Route::post('/tlsubmission-approve', [TLApproval::class, 'store']);


// Submission Active Requirement
Route::get('/tlsubmission-active/{id}', [TLRequirement::class, 'create']);
Route::Post('/tlsubmission-active/{id}', [TLRequirement::class, 'store']);
Route::get('/tlsubmission-inbox', [TLRecruiterSubmission::class, 'create']);



// Additional routes if needed...
