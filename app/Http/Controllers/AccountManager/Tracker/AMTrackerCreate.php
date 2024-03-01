<?php

namespace App\Http\Controllers\AccountManager\Tracker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tracker;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class AMTrackerCreate extends Controller
{
    public function create(Request $request)
    {
        $am =  Client::select('client_name', 'business_unit_name', 'location')
            ->distinct()
            ->where('location', '!=', null)
            ->whereRaw("TRIM(location) != ''") // Add this for spaces
            ->get();

        return response()->json(['client' => $am]);
    }

    public function store(Request $request)
    {
        $messages = [

            'selectedClient.required' => 'Client Name is required.',

            'clientManagerName.required' => 'Client Manager is required.',

            'selectedBusiness.required' => ' Buisness Unit is required.', // Example for customizing unique constraint message

            'selectedLocation.required' => 'Location is required.',

            'file.required' => ' File Upload is required.',

            // Add other custom messages as needed

        ];
        // $customValidation = [

        //     'selectedClient.required' => 'required',
        //     'clientManagerName' => 'required',
        //     'selectedBusiness' => 'required',
        //     'selectedLocation' => 'required',
        //     'file' => 'required|file|mimes:xls,xlsx|max:2048',



        //     // Add other custom messages as needed

        // ];
        $request->validate([
            'selectedClient' => 'required',
            'clientManagerName' => 'required',
            'selectedBusiness' => 'required',
            'selectedLocation' => 'required',
            'file' => 'required|file|mimes:xls,xlsx|max:2048',
        ], $messages);


        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('trackers', $fileName, 'public');

        $clientManagerName = ucwords($request->clientManagerName);

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

        return response()->json(['message' => 'Tracker has been created successfully']);
    }
}
