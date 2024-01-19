<?php

namespace App\Http\Controllers\Editor\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Login;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class EditorUserLogin extends Controller
{
    public function create()
    {
        $login = Login::select('login_id', 'email_id', 'location', 'created_at', 'logout_time')->distinct()
            ->get();

        return response()->json(['login' => $login]);
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'toDate' => 'required',
            'fromDate' => 'required',
            'selectedEmail' => 'required',
            'selectedLocation' => 'required',
            // Add any other form field validations here
        ]);

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
            // Assuming 'created_at' is the date field in your Login model
            $query->whereBetween(DB::raw('Date(created_at)'), [$fromDate, $toDate]);
        }
        $query->orderby('created_at', 'asc');

        $results = $query->get();

        // Retrieve the generated SQL queries after the query execution
        // $queryLog = DB::getQueryLog();

        // Log the queries (you can check your Laravel logs for these)
        //  Log::debug($queryLog);

        //dd($results);

        return response()->json(['results' => $results]);
    }
}
