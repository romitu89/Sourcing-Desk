<?php

namespace App\Http\Controllers\AccountManager\Tracker;

use Illuminate\Support\Facades\DB;
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
            ->where('account_manager_id','=',auth()->user()->id)
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

        $userEmail = auth()->user()->email_id;
        $tracker_id = DB::table('trackers')
        ->where('client_name', $request->selectedClient)
        ->where('business_unit', $request->selectedBusiness)
        ->where('location', $request->selectedLocation)
        ->where('client_manager_name', $request->clientManagerName)
        ->where('created_by', $userEmail)
        ->value('tracker_id');
       if($tracker_id != null){
        Tracker::where('tracker_id', $tracker_id)->delete();
       }

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
