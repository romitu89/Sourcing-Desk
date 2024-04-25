<?php

namespace App\Http\Controllers\Recruiter\Submission;

use App\Http\Controllers\Controller;
use App\Models\RequestCreation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Submission;

class RecruiterSubmission extends Controller
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

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'candidate_name' => 'required',
            'primary_skills' => 'required',
            'rate_communication' => 'required',
            'rate_technicality' => 'required',
            'total_experience' => 'required',
            'relevant_experience' => 'required',
            'notice_period' => 'required',
            'current_ctc' => 'required',
            'expected_ctc' => 'required',
            'mobile_number' => 'required',
            'email_id' => 'required',
            'candidate_profile_path' => 'required',
            'vendor_tracker_path' => 'required',
            'current_location' => 'required',
            'job_location' => 'required',
            'location' => 'required',
            'submitted_by' => 'required',
            'status' => 'nullable',
            'reason' => 'nullable',
        ]);



        // Create a new Submission instance
        $submission = new Submission([
            'candidate_name' => $request->candidate_name,
            'primary_skills' => $request->primary_skills,
            'rate_communication' => $request->rate_communication,
            'rate_technicality' => $request->rate_technicality,
            'total_experience' => $request->total_experience,
            'relevant_experience' => $request->relevant_experience,
            'notice_period' => $request->notice_period,
            'current_ctc' => $request->current_ctc,
            'expected_ctc' => $request->expected_ctc,
            'mobile_number' => $request->mobile_number,
            'email_id' => $request->email_id,
            'candidate_profile_path' => $request->candidate_profile_path,
            'vendor_tracker_path' => $request->vendor_tracker_path,
            'current_location' => $request->current_location,
            'job_location' => $request->job_location,
            'location' => $request->location,
            'submitted_by' => $request->submitted_by,
            'status' => $request->status,
            'reason' => $request->reason,
        ]);

        // Save the Submission record
        $submission->save();

        return response()->json(['message' => 'Submission created successfully'], 201);
    }
}
