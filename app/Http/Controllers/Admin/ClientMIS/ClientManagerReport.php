<?php

namespace App\Http\Controllers\Admin\ClientMIS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientManagerReport extends Controller
{
    public function create()
    {
        // Fetch data for locations, client names, and business unit names
        $clients = Client::select('client_name')->get();
        $businessUnits = Client::select('business_unit_name')->distinct()->get();
        $locations = Client::select('location')->distinct()->get();
        $clientManager = Client::select('client_manager_name')->distinct()->get();


        // Return the fetched data as JSON response
        return response()->json([
            'clients' => $clients,
            'businessUnits' => $businessUnits,
            'locations' => $locations,
            'clientManager' => $clientManager,

        ]);
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'clientName' => 'required',
            'businessName' => 'required',
            'selectedLocation' => 'required',
            'clientManager' => 'required',
            'matrix' => 'required',
            'from' => 'required|date',
            'to' => 'required|date',
        ]);

        $clientName = $request->input('clientName');
        $business = $request->input('businessName');
        $defaultLocation = $request->input('selectedLocation');
        $clientManager = $request->input('selectedLocation');
        $query = Client::query();

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        if ($business) {
            $query->where('business_unit_name', '=', $business);
        }

        if ($clientName) {
            $query->where('client_name', '=', $clientName);
        }

        if ($clientManager) {
            $query->where('client_manager_name', '=', $clientManager);
        }

        $results = $query->get();

        return Response::json(['results' => $results]);
    }

    //     $client = new Client([

    //         'client_name' => $request->userName,
    //         'business_unit_name' =>  $request->businessName,
    //         'location' => $request->selectedLocation,
    //         'matrix' =>  $request->matrix,
    //         'from' =>   $request->from,
    //         'to' =>  $request->to,

    //     ]);
    //     $client->save();

    //     $results = Client::all();

    //     return Response::json(['results' => $results]);
    // }
}
