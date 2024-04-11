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
        $subLocation = Client::select('sub_location')->distinct()->get();

        return Response::json(['locations' => $location, 'subLocations' => $subLocation]);
    }

    public function edit(string $id)
    {
        $am = User::where('role', 'accountManager')->distinct()
            ->get();
        $client = Client::where('client_id', $id)->first();
        // dd($client->client_id);
        $user = User::where('id', $client->account_manager_id)->first();
        // dd($user);
        if ($user) {
            $client->am_email = $user->email_id;
        } else {
            $client->am_email = null; // or some default value
        }
        return response()->json([
            'client' => $client,
            'accountmanager' => $am
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'clientName' => 'required|string|unique:clients,client_name,' . $id . ',client_id',
            'businessName' => 'required|string',
            'subLocation' => 'required|string',
            'selectedManagerName' => 'required',
            'selectedManager' => 'required|email|unique:clients,client_manager_email,' . $id . ',client_id',
            'selectedLocation' => 'required',
            'selectedAccountManager' => 'required',
        ]);

        // if ($request->selectedManager) {
        //     $am_email = $request->selectedManager;
        // }
        $man_id = $request->selectedManager;
        $clientName = ucwords($request->clientName);
        $bun = ucwords($request->businessName);
        $subLoc = ucwords($request->subLocation);

        $acc_id = User::where('email_id', $request->selectedAccountManager)->first(['id']);
        $client = Client::findOrFail($id);

        $client->update([
            'client_name' => $clientName,
            'business_unit_name' => $bun,
            'sub_location' => $subLoc,
            'client_manager_name' =>  ucwords($request->selectedManagerName),
            'client_manager_email' =>  $man_id,
            'account_manager_id' => $acc_id->id,
            'location' => $request->selectedLocation,
        ]);

        return Response::json(['message' => 'Client has been updated']);
    }

    public function store(Request $request)
    {
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

        $results = $query->get();

        return Response::json(['results' => $results]);
    }

    public function destroy(string $id)
    {
        Client::deleted($id);
        return response()->json(['message' => 'Client has been deleted']);
    }
}
