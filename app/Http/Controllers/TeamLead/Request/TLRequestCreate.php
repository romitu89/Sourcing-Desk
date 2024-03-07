<?php

namespace App\Http\Controllers\TeamLead\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\RequestCreation;
use App\Models\Teams;
use Illuminate\Support\Facades\Validator;

class TLRequestCreate extends Controller
{
    public function create()
    {

        $cli = Client::select('client_name', 'business_unit_name', 'location')
            ->distinct()
            ->where('account_manager', auth()->user()->email_id)
            ->get();

        $teamb = Teams::select('team_members')
            ->distinct()
            ->where('created_by', auth()->user()->email_id)
            ->get();

        $teams = [];

        foreach ($teamb as $result) {
            $decodedTeamMembers = json_decode($result->team_members);
            $flattenedTeamMembers = implode(', ', $decodedTeamMembers[0]); // This assumes that $decodedTeamMembers[0] is an array
            $teams[] =  $flattenedTeamMembers;
        }

        return response()->json([
            'teamEmail' => $teams,
            'client' => $cli
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        //dd($request->all());

        $messages = [

            'subject.required' => 'Subject is required.',

            'requestBody.required' => 'Request Body is required.',

            'requirement.required' => 'Requirement is required.',

            'jobType.required' => 'Job Type is required.',

            'selectedClient.required' => 'Client Name is required.',

            'clientManager.required' => 'Client Manager is required.',

            'selectedBusiness.required' => ' Buisness Unit is required.',

            'selectedLocation.required' => 'Location is required.',


            'selectedTeam.required' => 'Location is required.',

        ];



        $request->validate([
            'subject' => 'required',

            'requestBody' => 'required',
            'requirement' => 'required',
            'jobType' => 'required',

            'selectedClient' => 'required',
            'selectedBusiness' => 'required',
            'selectedLocation' => 'required',
            'clientManager' => 'required',
            // 'file' => 'required|file|mimes:xls,xlsx|max:2048', // Max file size in kilobytes (2MB in this example)


            'selectedTeam' => 'required',
        ], $messages);
        $currentTime = Carbon::now()->format('YmdHis'); // Get current time as YYYYMMDDHHMMSS string
        $randomNumber = rand(100, 99999); // generate a random number between 10000 and 9999999

        $requirement_num = $randomNumber . $currentTime;
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('trackers', $fileName, 'public');
        $teams = new RequestCreation([

            'subject_line' => $request->subject,
            'request_body' => $request->requestBody,

            'requirement_name' => $request->requirement,

            'requirement_num' => $requirement_num,
            'file_upload_jd' => $filePath,


            'job_type' => $request->jobType,
            'client_name' => $request->selectedClient,
            'client_bu' => $request->selectedBusiness,

            'client_location' => $request->selectedLocation,

            'client_manager' => $request->clientManager,
            'work_assigned_to' => json_encode($request->selectedTeam),


            'created_by' => auth()->user()->email_id,
            'user_id' => auth()->user()->id,
        ]);
        $teams->save();

        return response()->json(['message' => 'Request created successfully']);
    }
}
