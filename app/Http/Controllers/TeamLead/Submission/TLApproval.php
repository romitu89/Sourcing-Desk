<?php

namespace App\Http\Controllers\TeamLead\Submission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Response;

class TLApproval extends Controller
{
    public function create()
    {

        $am = Submission::Select('location')->distinct()
            ->get();
        return response()->json(['location' => $am]);
    }

    public function updateStatus(Request $request, string $submissionId)
    {

        $status = $request->input('status');
        $reason = $request->input('reason', null); // Optional

        // Assuming you have a Submission model
        $submission = Submission::findOrFail($submissionId);

        if ($submission) {
            $submission->status = $status;
            if ($status === 'Rejected' && $reason) {
                $submission->reason = $reason;
            }
            $submission->save();
        }

        $defaultLocation = $request->input('location');

        $query = Submission::query();

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        // if ($defaultClient) {
        //     $query->where('client_name', '=', $defaultClient);
        // }
        $query->where('status', '=', null);



        $data = $query->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $messages = [

            'selectedLocation.required' => 'Location is required.',

        ];


        $request->validate([

            'selectedLocation' => 'required',
            // Add any other form field validations here
        ], $messages);


        $defaultLocation = $request->input('selectedLocation');

        $query = Submission::query();

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        // if ($defaultClient) {
        //     $query->where('client_name', '=', $defaultClient);
        // }
        $query->where('status', '=', null);



        $results = $query->get();

        return response()->json(['results' => $results]);
    }

    // public function destroy(string $id)
    // {
    //     Client::deleted($id);
    //     return redirect(route('adminclient-view'))->with('successMessage', 'Client has been deleted');
    // }
}
