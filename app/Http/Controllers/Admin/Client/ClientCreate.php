<?php

namespace App\Http\Controllers\Admin\Client;

use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class ClientCreate extends Controller
{
    public function create()
    {
        $accountManagers = User::where('role', 'accountManager')->distinct()->get();

        return response()->json(['accountmanagers' => $accountManagers]);
    }


    public function store(Request $request)
    {



        // dd($request->all());

        $successMessage = [

            'selectedLocation.required' => 'Location is required.',

            'selectedManager.required' => 'Manager is required.',

            'businessName.required' => 'Unit is required.',

            'subLocation.required' => 'Sub Location is required.',



            // Add other custom messages as needed

        ];




        $request->validate([
            'clientName' => 'required|string|unique:clients,client_name',
            'businessName' => 'required|string',
            'subLocation' => 'required|string',

            'selectedManager' => 'required',
            'selectedLocation' => 'required',

        ],$successMessage);
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
        return response()->json(['successMessage' => 'Client is Created'],);
    }
}
