<?php

namespace App\Http\Controllers\Editor\ClientMIS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Client;

class EditorClientReport extends Controller
{
    public function create()
    {

        $clients = Client::select('client_name', 'business_unit_name', 'location')->get();

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
            'selectedMatrix' => 'required',
            'fromDate' => 'required|date',
            'toDate' => 'required|date',
        ]);

        $clientName = $request->input('clientName');
        $business = $request->input('businessName');
        $defaultLocation = $request->input('selectedLocation');
        // $matrix = $request->input('selectedMatrix');
        // $fromDate = $request->input('fromDate');
        // $toDate = $request->input('toDate');
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

        // if ($matrix) {
        //     $query->where('location', '=', $matrix);
        // }

        // if ($business) {
        //     $query->where('business_unit_name', '=', $business);
        // }

        // if ($clientName) {
        //     $query->where('client_name', '=', $clientName);
        // }

        $results = $query->get();

        return Response::json(['results' => $results]);
    }
}
