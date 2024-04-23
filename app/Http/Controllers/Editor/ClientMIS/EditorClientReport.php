<?php

namespace App\Http\Controllers\Editor\ClientMIS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $successMessage = [

            'clientName.required' => 'Client Name is required.',
            'businessName.required' => 'Buisness Unit Name is required.',
            'selectedLocation.required' => 'Location is required.',
            'selectedMatrix.required' => 'Matrix is required.',
            'fromDate.required' => 'From Date is required.',
            'toDate.required' => 'To Date is required.',
        ];
        // Validate the form data
        $request->validate([
            'clientName' => 'required',
            'businessName' => 'required',
            'selectedLocation' => 'required',
            'selectedMatrix' => 'required',
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

        $clientName = $request->input('clientName');
        $business = $request->input('businessName');
        $defaultLocation = $request->input('selectedLocation');
        // $matrix = $request->input('selectedMatrix');
        $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('fromDate'));
        $toDate = Carbon::createFromFormat('Y-m-d', $request->input('toDate'));

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

        if ($fromDate && $toDate) {
            $query->whereBetween(DB::raw('Date(created_at)'), [$fromDate->toDateString(), $toDate->toDateString()]);
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
