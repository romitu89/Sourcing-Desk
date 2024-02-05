<?php

namespace App\Http\Controllers\Admin\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;

class ClientView extends Controller
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

        $client = Client::findOrFail($id);

        $client->update([
            'client_name' => $clientName,
            'business_unit_name' => $bun,
            'sub_location' => $subLoc,
            'account_manager' => $am_name_nw,
            'account_manger_id' => $request->selectedManager,
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
        ],$clientValidation );

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
