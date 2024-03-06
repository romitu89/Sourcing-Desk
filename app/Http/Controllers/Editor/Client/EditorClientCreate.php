<?php

namespace App\Http\Controllers\Editor\Client;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class EditorClientCreate extends Controller
{
    public function create()
    {
        $am = User::where('role', 'accountManager')->distinct()
            ->get();

        return response()->json(['accountmanager' => $am]);
    }

    public function store(Request $request)
    {


        //dd($request->all());

        $successMessage = [

            'clientName.required' => 'Client Name is required.',

            'selectedLocation.required' => 'Location is required.',

            'selectedManager.required' => 'Manager is required.',

            'businessName.required' => 'Buisness Unit is required.',

            'subLocation.required' => 'Sub Location is required.',


            // Add other custom messages as needed

        ];


        $request->validate([
            'clientName' => 'required|string|unique:clients,client_name',
            'businessName' => 'required|string',
            'subLocation' => 'required|string',

            'selectedManager' => 'required',
            'selectedLocation' => 'required',

        ], $successMessage);
        $man_id = $request->selectedManager;
        if ($man_id) {
            $man_id = User::where('email_id', $man_id)
                ->pluck('id')->implode('');
        }
        $clientName = ucwords($request->clientName);
        $bun = ucwords($request->businessName);
        $subLoc = ucwords($request->subLocation);

        $client = new Client([

            'client_name' =>  $clientName,
            'business_unit_name' => $bun,

            'sub_location' => $subLoc,
            'location' => $request->selectedLocation,
            'account_manager_id' =>  $man_id,
            'account_manager' =>  $request->selectedManager



        ]);
        $client->save();
        return response()->json(['message' => 'Client created successfully']);
    }
}
