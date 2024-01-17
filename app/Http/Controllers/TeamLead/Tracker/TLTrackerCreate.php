<?php

namespace App\Http\Controllers\TeamLead\Tracker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Tracker;
use Illuminate\Support\Facades\Response;

class TLTrackerCreate extends Controller
{
    public function create(Request $request)
    {

        $am = Client::Select('client_name', 'business_unit_name', 'location')->distinct()
            ->get();
        return response()->json(['client' => $am]);
    }

    public function store(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'selectedClient' => 'required',
            'clientManagerName' => 'required',
            'selectedBusiness' => 'required',
            'selectedLocation' => 'required',
            'file' => 'required|file|mimes:xls,xlsx|max:2048', // Max file size in kilobytes (2MB in this example)

        ]);
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('trackers', $fileName, 'public'); // Store file in 'public/uploads' directory
        $clientManagerName = ucwords($request->clientManagerName);
        // dd($request->all());
        // Create a new Tracker record with the file path
        $tracker = new Tracker([


            'client_manager_name' =>  $clientManagerName,
            'client_name' => $request->selectedClient,
            'business_unit' => $request->selectedBusiness,
            'location' => $request->selectedLocation,
            'tracker_file' => $filePath,
            'created_by' => auth()->user()->email_id,
            'user_id' =>   auth()->user()->id,

        ]);
        $tracker->save();

        return response()->json(['message' => 'Tracker created successfully']);
    }
}
