<?php

namespace App\Http\Controllers\AccountManager\TeamManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teams;
use App\Models\User;

class TeamView extends Controller
{
    public function create()
    {

        $tm = Teams::Select('location')->distinct()->where('created_by', auth()->user()->email_id)
            ->get();
        return response()->json(['teamData' => $tm]);
    }

    public function edit(string $id)
    {

        $totalTm = [];
        $selectedTm = [];

        $tm = User::Select('email_id', 'location')->distinct()->where('reporting_to', auth()->user()->email_id)
            ->get();


        $team = Teams::where('team_id', $id)->first();

        $decodedTeamMembers = json_decode($team->team_members);
        $flattenedTeamMembers = implode(',', $decodedTeamMembers[0]);

        // Assuming 'team_members' contains an array, you can push it into the $teams array.
        $selectedTm[] = $flattenedTeamMembers;


        return response()->json([
            'result' => $team,
            'teamData' => $tm,
            'selectedTm' => $selectedTm,
        ],);
    }

    public function update(Request $request, string $id)
    {
        //dd($request->all());

        $request->validate([

            'selectedLocation' => 'required',
            'selectedTeam' => 'required',
            'jobType' => 'required',

        ]);


        //dd($request->except('_token','_method'));
        $team = Teams::findOrFail($id);

        // Update the client with the validated data
        $team->update([
            'team_members' => json_encode([$request->selectedTeam]),
            'job_type' => $request->jobType,

            'location' => $request->selectedLocation,



        ]);
        return response()->json(['message' => 'Team has been updated'],);
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $messages = [

            'selectedLocation.required' => 'Location is required.',

        ];



        $request->validate([

            'selectedLocation' => 'required',
            // Add any other form field validations here
        ], $messages);


        $defaultLocation = $request->input('selectedLocation');



        $query = Teams::query();

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        if (auth()->user()->email_id) {
            $query->where('created_by', '=', auth()->user()->email_id);
        }

        $results = $query->get();
        $teams = [];

        foreach ($results as $result) {
            $decodedTeamMembers = json_decode($result->team_members);
            $flattenedTeamMembers = implode(', ', $decodedTeamMembers[0]);

            // Assuming 'team_members' contains an array, you can push it into the $teams array.
            $teams[] = $flattenedTeamMembers;
        }

        return response()->json(['results' => $results, 'teamMembers' => $teams],);
    }

    // public function destroy(string $id)
    // {
    //     Client::deleted($id);
    //     return redirect(route('adminclient-view'))->with('successMessage', 'Client has been deleted');
    // }
}
