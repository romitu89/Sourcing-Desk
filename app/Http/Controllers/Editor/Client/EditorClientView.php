<?php

namespace App\Http\Controllers\Editor\Client;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class EditorClientView extends Controller
{
    public function create()
    {
        $location = Client::select('location')->distinct()->get();
        $subLocatin = Client::select('sub_location')->distinct()->get();

        return response()->json(['locations' => $location, 'subLocations' => $subLocatin]);
    }

    public function edit(string $id)
    {
        $am = User::where('role', 'accountManager')->distinct()
            ->get();
        $client = Client::where('client_id', $id)->first();
        return response()->json(['client' => $client, 'accountManager' => $am]);
    }
    public function update(Request $request, string $id)
    {

        $request->validate([
            'clientName' => 'required|string|unique:clients,client_name,' . $id . ',client_id',
            'businessName' => 'required|string',
            'subLocation' => 'required|string',

            'selectedManager' => 'required',
            'selectedLocation' => 'required',

        ]);


        if ($request->selectedManager) {
            $am_email = $request->selectedManager;
        }
        $clientName = ucwords($request->clientName);
        $bun = ucwords($request->businessName);
        $subLoc = ucwords($request->subLocation);
        $am_name_nw = ucwords($am_email);
        //dd($request->except('_token','_method'));
        $client = Client::findOrFail($id);

        // Update the client with the validated data
        $client->update([
            'client_name' => $clientName,
            'business_unit_name' => $bun,
            'sub_location' => $subLoc,
            'account_manager' => $am_name_nw,
            'account_manger_id' => $request->selectedManager,
            'location' => $request->selectedLocation,
        ]);
        return response()->json(['message' => 'Client updated successfully']);
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $clientValidation = [

            'selectedLocation.required' => 'Location is required.',

            'selectedSubLocation.required' => 'Sub Location is required.',



            // Add other custom messages as needed

        ];

        $request->validate([
            'selectedSubLocation' => 'required',
            'selectedLocation' => 'required',


        ], $clientValidation);

        $subLocation = $request->input('selectedSubLocation');
        $defaultLocation = $request->input('selectedLocation');
        $query = Client::query();

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        if ($subLocation) {
            $query->where('sub_location', '=', $subLocation);
        }



        // Add more conditions as needed

        // Execute the query and retrieve the results
        $results = $query->get();

        return response()->json(['results' => $results]);
        //dd($results);
    }

    public function destroy(string $id)
    {
        Client::deleted($id);
        return response()->json(['message' => 'Client deleted successfully']);
    }
}
