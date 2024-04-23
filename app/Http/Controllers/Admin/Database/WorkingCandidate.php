<?php

namespace App\Http\Controllers\Admin\Database;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
            'toDate' => 'required|date_format:Y-m-d|after_or_equal:fromDate|before_or_equal:' . now()->format('Y-m-d'),
            'fromDate' => 'required|date_format:Y-m-d|before_or_equal:toDate|before_or_equal:' . now()->format('Y-m-d'),

        ], [
            'toDate.required' => 'To Date is required.',
            'fromDate.required' => 'From Date is required.',
            'toDate.date_format' => 'Invalid format for To Date. Use YYYY-MM-DD format.',
            'fromDate.date_format' => 'Invalid format for From Date. Use YYYY-MM-DD format.',
            'toDate.after_or_equal' => 'To Date must be after or equal to From Date.',
            'fromDate.before_or_equal' => 'From Date must be before or equal to To Date and current date.',
        ], $successMessage);

        $defaultLocation = $request->input('selectedLocation');
        $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('fromDate'));
        $toDate = Carbon::createFromFormat('Y-m-d', $request->input('toDate'));

        $query = Location::query();

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween(DB::raw('Date(created_at)'), [$fromDate->toDateString(), $toDate->toDateString()]);
        }

        $results = $query->get();

        return Response::json(['results' => $results]);
    }
}
