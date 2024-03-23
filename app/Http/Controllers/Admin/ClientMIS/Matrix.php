<?php

namespace App\Http\Controllers\Admin\ClientMIS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Client;

class Matrix extends Controller
{
    public function create()
    {
        // Fetch data for locations, client names, and business unit names
        $clients = Client::select('client_name', 'business_unit_name', 'location')->distinct()->get();


        // Return the fetched data as JSON response
        return response()->json([
            'clients' => $clients,

        ]);
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'clientName' => 'required',
            'businessName' => 'required',
            'selectedLocation' => 'required',
            'matrix' => 'required',

        ]);

        $clientName = $request->input('clientName');
        $business = $request->input('businessName');
        $defaultLocation = $request->input('selectedLocation');
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
