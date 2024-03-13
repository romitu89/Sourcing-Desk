<?php

namespace App\Http\Controllers\Admin\Client;

use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;


class ClientCreate extends Controller
{
    public function create()
    {
        $accountManagers = Location::select('country')->distinct()
        ->get();

        return response()->json(['accountmanagers' => $accountManagers]);
    }


    public function store(Request $request)
    {



        // dd($request->all());

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
            'selectedManagerName' => 'required',
            'selectedManager' => 'required|email|unique:clients,client_manager_email',
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
            'client_manager_name' =>  ucwords($request->selectedManagerName),
            'client_manager_email' =>  $man_id,
            'account_manager_id' => auth()->user()->id



        ]);
        $client->save();
        return response()->json(['successMessage' => 'Client is Created'],);
    }
}
