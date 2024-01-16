<?php

namespace App\Http\Controllers\AccountManager\Candidate;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Submission;
use App\Models\Interview;

class AMInterview extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = [];

        try {
            // Check if query is an email
            $this->validate($request, [
                'query' => 'email',
            ]);

            // If validation passed, then it's an email
            $results = Submission::where('email_id', 'LIKE', '%' . $query . '%')
                ->where('status', '!=', '""')
                ->select('email_id') // Select only the email_id column
                ->get();
        } catch (ValidationException $e) {

            // If validation failed, let's check if it's a mobile number
            if (is_numeric($query)) {
                $results = Submission::where('mobile_number', 'LIKE', '%' . $query . '%')
                    ->where('status', '!=', '""')
                    ->select('mobile_number') // Select only the mobile_number column
                    ->get();
            }
        }

        return response()->json($results);
    }

    public function create()
    {
        // dd($request->all());
        $candidate = Submission::Select('created_at', 'candidate_name', 'request_no', 'mobile_number', 'email_id', 'primary_skills', 'submitted_by', 'client_manager')->distinct()->where('mobile_number')
            ->get();

        return response()->json(['candidate' => $candidate]);
    }


    public function updateStatus(Request $request)
    {
        //dd($request->request_no);
        $status = $request->status;
        // $status = $request->status;

        // $exists = false;
        // switch ($status) {
        //     case 'selected':
        //     case 'rejected':
        //         $exists = Selection::where('submission_id', $request->submission_id)->exists();
        //         break;
        //     case 'onboarded':
        //     case 'drop':
        //         $exists = Onboarded::where('submission_id', $request->submission_id)->exists();
        //         break;
        // }

        // if ($exists) {
        //     return response()->json("Candidate already {$status}");
        // }


        $interview = new Interview([
            'request_no' => $request->request_no,
            'submission_id' => $request->submission_id,
            'interview_date' => date('m/d/Y'),
            'interview_status' => $request->status,

            'interview_feedback' => $request->remarks,

            'candidate_email' => $request->email_id,
            'candidate_name' => $request->candidate_name,
            'candidate_mobile' => $request->mobile_number,
            'processed_by' => $request->submitted_by,
            'assigned_by' => auth()->user()->email_id,
            'location' => auth()->user()->location
        ]);
        $interview->save();
        return response()->json(["message" => "Candidate $status successfully updated"]);
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $query = $request->input('query');
        $results = [];

        try {
            // Check if query is an email
            $this->validate($request, [
                'query' => 'email',
            ]);

            // If validation passed, then it's an email
            $results = Submission::where('email_id', '=',  $query)
                ->where('status', '!=', '""')
                ->get();
        } catch (ValidationException $e) {
            // If validation failed, let's check if it's a mobile number
            if (is_numeric($query)) {
                $results = Submission::where('mobile_number', '=',  $query)
                    ->where('status', '!=', '""')
                    // Select only the mobile_number column
                    ->get();
            }
        }

        // Render the same view with the results data
        return response()->json(['results' => $results]);
    }
}
