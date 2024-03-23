<?php

namespace App\Http\Controllers\AccountManager\ClientMIS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Client;

class AMMatrix extends Controller
{
    public function create()
    {

        $clients = Client::select('client_name', 'business_unit_name', 'location')->distinct()->get();

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
}
