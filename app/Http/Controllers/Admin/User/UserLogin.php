<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Login;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserLogin extends Controller

{
    public function create()
    {
        $login = Login::select('login_id', 'email_id', 'location', 'created_at', 'logout_time')->distinct()
            ->get();

        return response()->json(['login' => $login]);
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $results = [

            'selectedLocation.required' => 'Location is required.',

            'selectedEmail.required' => 'Email is required.',

            'fromDate.required' => 'From Date is required.',

            'toDate.required' => 'To Date is required.',



            // Add other custom messages as needed

        ];



        $request->validate([
            'toDate' => 'required',
            'fromDate' => 'required',
            'selectedEmail' => 'required',
            'selectedLocation' => 'required',
            // Add any other form field validations here
        ], $results);

        $defaultLocation = $request->input('selectedLocation');
        $defaultEmail = $request->input('selectedEmail');
        $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('fromDate'))->toDateString();
        $toDate = Carbon::createFromFormat('Y-m-d',  $request->input('toDate'))->toDateString();


        $query = Login::query();

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        if ($defaultEmail) {
            $query->where('email_id', '=', $defaultEmail);
        }

        if ($fromDate && $toDate) {

            $query->whereBetween(DB::raw('Date(created_at)'), [$fromDate, $toDate]);
        }
        $query->orderby('created_at', 'asc');

        $results = $query->get();

        return response()->json(['results' => $results]);
    }
}
