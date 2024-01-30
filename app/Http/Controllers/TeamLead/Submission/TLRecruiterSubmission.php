<?php

namespace App\Http\Controllers\TeamLead\Submission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestCreation;
use Illuminate\Support\Facades\Response;

class TLRecruiterSubmission extends Controller
{
    public function create()
    {

        $results = RequestCreation::select('request_creations.request_id', 'request_creations.subject_line', 'request_creations.file_upload_jd', 'request_creations.created_at', 'request_creations.client_manager', 'request_creations.created_by', 'request_creations.request_body', 'users.employee_name')
            ->join('users', 'request_creations.created_by', '=', 'users.email_id')
            ->whereRaw('JSON_SEARCH(request_creations.work_assigned_to, "one", ?) IS NOT NULL', [auth()->user()->email_id])
            ->distinct()
            ->get();

        return response()->json(['userEmail' => $results]);
    }
}
