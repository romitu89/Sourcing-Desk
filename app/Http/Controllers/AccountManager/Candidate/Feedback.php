<?php

namespace App\Http\Controllers\AccountManager\Candidate;

use Illuminate\Validation\ValidationException;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Selection;
use App\Models\Onboarded;

class Feedback extends Controller
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

        $exists = false;
        switch ($status) {
            case 'selected':
            case 'rejected':
                $exists = Selection::where('submission_id', $request->submission_id)->exists();
                break;
            case 'onboarded':
            case 'drop':
                $exists = Onboarded::where('submission_id', $request->submission_id)->exists();
                break;
        }

        if ($exists) {
            return response()->json(["message" => "Candidate already {$status}"]);
        }
        switch ($status) {
            case 'selected':

                $selection = new Selection([
                    'request_no' => $request->request_no,
                    'submission_id' => $request->submission_id,
                    'selection_date' => date('m/d/Y'),
                    'selection_result' => $request->status,
                    'remarks' => $request->remarks,
                    'candidate_email' => $request->email_id,
                    'candidate_name' => $request->candidate_name,
                    'candidate_mobile' => $request->mobile_number,
                    'processed_by' => $request->submitted_by,
                    'assigned_by' => auth()->user()->email_id
                ]);
                $selection->save();
                return response()->json("Candidate Selection successfully updated");
                break;

            case 'rejected':
                // Handle 'rejected' status
                $rejection = new Selection([
                    'request_no' => $request->request_no,
                    'submission_id' => $request->submission_id,
                    'selection_date' => date('m/d/Y'),
                    'selection_result' => $request->status,
                    'remarks' => $request->remarks,
                    'candidate_email' => $request->email_id,
                    'candidate_name' => $request->candidate_name,
                    'candidate_mobile' => $request->mobile_number,
                    'processed_by' => $request->submitted_by,
                    'assigned_by' => auth()->user()->email_id
                ]);
                $rejection->save();
                return response()->json("Candidate Rejection successfully updated");
                break;

            case 'onboarded':
                // Handle 'onboarded' status
                $onboarded = new Onboarded([

                    'request_no' => $request->request_no,
                    'submission_id' => $request->submission_id,
                    'onboarded_date' => date('m/d/Y'),
                    'onboarded_result' => $request->status,
                    'remarks' => $request->remarks,
                    'candidate_email' => $request->email_id,
                    'candidate_name' => $request->candidate_name,
                    'candidate_mobile' => $request->mobile_number,
                    'processed_by' => $request->submitted_by,
                    'assigned_by' => auth()->user()->email_id
                ]);
                $onboarded->save();
                return response()->json("Candidate Onboard successfully updated");
                break;

            case 'drop':
                // Handle 'drop' status
                $drop = new Onboarded([

                    'request_no' => $request->request_no,
                    'submission_id' => $request->submission_id,
                    'onboarded_date' => date('m/d/Y'),
                    'onboarded_result' => $request->status,
                    'remarks' => $request->remarks,
                    'candidate_email' => $request->email_id,
                    'candidate_name' => $request->candidate_name,
                    'candidate_mobile' => $request->mobile_number,
                    'processed_by' => $request->submitted_by,
                    'assigned_by' => auth()->user()->email_id
                ]);
                $drop->save();
                return response()->json("Candidate Drop successfully updated");
                break;

            default:
                // Handle other statuses or errors
                return response()->json(["message" => "Nothing is updated"]);
                break;
        }

        return response()->json($status);
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
