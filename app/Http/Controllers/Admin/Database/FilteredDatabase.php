<?php

namespace App\Http\Controllers\Admin\Database;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Location;

class FilteredDatabase extends Controller
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
        // Validate the form data
        $request->validate([

            'selectedLocation' => 'required',
            'SelectedDuration' => 'required|',

        ]);

        $defaultLocation = $request->input('selectedLocation');

        $query = Location::query();

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        $results = $query->get();

        return Response::json(['results' => $results]);
    }
}
