<?php

namespace App\Http\Controllers\Editor\ClientMIS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Client;

class EditorClientManager extends Controller
{
    public function create()
    {

        $clients = Client::select('client_name', 'client_manager_name', 'business_unit_name', 'location')->distinct()->get();

        return response()->json([
            'clients' => $clients,

        ]);
    }

    public function store(Request $request)
    {
        $successMessage = [

            'clientName.required' => 'Client Name is required.',
            'businessName.required' => 'Buisness Unit Name is required.',
            'selectedLocation.required' => 'Location is required.',
            'clientManager.required' => 'Client Manager is required.',
            'matrix.required' => 'Matrix is required.',
            'from.required' => 'From Date is required.',
            'to.required' => 'To Date is required.',
        ];
        // Validate the form data
        $request->validate([
            'clientName' => 'required',
            'businessName' => 'required',
            'selectedLocation' => 'required',
            'clientManager' => 'required',
            'matrix' => 'required',
            'from' => 'required|date',
            'to' => 'required|date',
        ], $successMessage);

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
}
