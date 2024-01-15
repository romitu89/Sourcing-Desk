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
        $am = Client::select('client_name', 'business_unit_name', 'location')->distinct()->get();

        return response()->json(['client' => $am]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'selectedClient' => 'required',
            'clientManagerName' => 'required',
            'selectedBusiness' => 'required',
            'selectedLocation' => 'required',
            'file' => 'required|file|mimes:xls,xlsx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
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
