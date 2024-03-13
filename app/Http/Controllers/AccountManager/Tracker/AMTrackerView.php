<?php

namespace App\Http\Controllers\AccountManager\Tracker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Tracker;


class AMTrackerView extends Controller
{
    public function create()
    {

        $am = Tracker::Select('client_name', 'business_unit', 'client_manager_name', 'location')->distinct()->where('created_by', auth()->user()->email_id)
            ->get();
        $user = auth()->user();
        return response()->json(['data' => $user, 'client' => $am]);

        // $am = Tracker::Select('client_name', 'business_unit', 'client_manager_name', 'location')->distinct()->where('created_by', auth()->user()->email_id)
        //     ->get();
        // return response()->json(['client' => $am]);
    }

    public function edit(string $id)
    {


        $am = Client::Select('client_name', 'business_unit_name', 'location')->distinct()
            ->get();
        $tracker = Tracker::where('tracker_id', $id)->first();
        return response()->json([
            'result' => $tracker,
            'client' => $am,
        ]);
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'selectedClient' => 'required',
            'selectedBusiness' => 'required',
            'clientManagerName' => 'required',
            'selectedLocation' => 'required',

        ]);


        $clientName = ucwords($request->selectedClient);
        $bun = ucwords($request->selectedBusiness);
        $cmn = ucwords($request->clientManagerName);

        //dd($request->except('_token','_method'));
        $client = Tracker::findOrFail($id);

        // Update the client with the validated data
        $client->update([
            'client_name' => $clientName,
            'business_unit' => $bun,

            'client_manager_name' => $cmn,
            'location' => $request->selectedLocation,
        ]);
        return response()->json(['results' => 'Tracker has been updated']);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $messages = [

            'selectedClient.required' => 'Client Name is required.',

            'selectedManager.required' => 'Client Manager is required.',

            'selectedBusiness.required' => ' Buisness Unit is required.', // Example for customizing unique constraint message

            'selectedLocation.required' => 'Location is required.',

        ];

        $request->validate([
            'selectedClient' => 'required', // Assuming 'clients' is the table name
            'selectedBusiness' => 'required',
            'selectedManager' => 'required', // Assuming 'users' is the table name
            'selectedLocation' => 'required',
            // Add any other form field validations here
        ], $messages);

        $defaultClient = $request->input('selectedClient');
        $defaultLocation = $request->input('selectedLocation');
        $defaultBusiness = $request->input('selectedBusiness');
        $defaultManager = $request->input('selectedManager');
        $query = Tracker::query();

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        if ($defaultClient) {
            $query->where('client_name', '=', $defaultClient);
        }

        if ($defaultBusiness) {
            $query->where('business_unit', '=', $defaultBusiness);
        }

        if ($defaultManager) {
            $query->where('client_manager_name', '=', $defaultManager);
        }
        $results = $query->get();

        return response()->json(['results' => 'Tracker has been stored']);
    }

    // public function destroy(string $id)
    // {
    //     Client::deleted($id);
    //     return redirect(route('adminclient-view'))->with('successMessage', 'Client has been deleted');
    // }
}
