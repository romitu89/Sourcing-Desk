<?php

namespace App\Http\Controllers\AccountManager\TeamManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teams;
use App\Models\Client;
use App\Models\User;

class TeamCreate extends Controller
{
    public function create()
    {
        $loc = Client::select('location')->distinct()->get();
        $client = Client::select('client_name')->distinct()->where("account_manager_id", auth()->user()->id)->get();
        $tm = User::select('email_id')->distinct()->where('reporting_to_am', auth()->user()->email_id)->get();

        return response()->json([
            'teamEmail' => $tm,
            'location' => $loc,
            'client' => $client
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        //dd($request->all());

        $messages = [

            'selectedLocation.required' => 'Location is required.',

            'jobType.required' => 'Job Type is required.',
            'clientName.required' => 'Client Name is required.',

            // 'selectedTeam.required' => 'Team is required.',

        ];


        $request->validate([
            'selectedTeam' => 'required',
            'clientName' => 'required',

            'selectedLocation' => 'required',
            'jobType' => 'required',
        ], $messages);

        $teams = new Teams([

            'client_name' => $request->clientName,
            'team_members' => json_encode([$request->selectedTeam]),
            'job_type' => $request->jobType,

            'location' => $request->selectedLocation,

            'created_by' => auth()->user()->email_id,
            'user_id' => auth()->user()->id,
        ]);





        // Create a new team record
        $teams->save();

        return response()->json(['message' => 'Team created successfully!']);
    }






    // public function destroy($id)
    // {
    //     // Delete the team record
    //     $team = Teams::findOrFail($id);
    //     $team->delete();

    //     return response()->json(['message' => 'Team deleted successfully!']);
    // }
}
