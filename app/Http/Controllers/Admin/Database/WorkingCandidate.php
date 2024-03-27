<?php

namespace App\Http\Controllers\Admin\Database;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Location;

class WorkingCandidate extends Controller
{
    public function create()
    {
        // Fetch data for locations, client names, and business unit names
        $location = Location::select('country')->distinct()->get();


        // Return the fetched data as JSON response
        return response()->json([
            'location' => $location,

        ]);
    }

    public function store(Request $request)
    {
        $successMessage = [

            'selectedLocation.required' => 'Country is required.',
            'fromDate.required' => 'From Date is required.',
            'toDate.required' => 'To Date is required.',
        ];
        // Validate the form data
        $request->validate([

            'selectedLocation' => 'required',
            'fromDate' => 'required|date',
            'toDate' => 'required|date',

        ], $successMessage);

        $defaultLocation = $request->input('selectedLocation');

        $query = Location::query();

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        $results = $query->get();

        return Response::json(['results' => $results]);
    }
}
