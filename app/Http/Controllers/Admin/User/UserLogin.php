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
        $login = Login::select('login_id', 'email_id', 'location', 'created_at', 'logout_time')->distinct()->get();

        return response()->json(['login' => $login]);
    }

    public function store(Request $request)
    {

        $successMessage = [

            'selectedLocation.required' => 'Location is required.',
            'selectedEmail.required' => 'Employee Email is required.',
            'fromDate.required' => 'From Date is required.',
            'toDate.required' => 'To Date is required.',


        ];
        $request->validate([
            'toDate' => 'required|date_format:Y-m-d|after_or_equal:fromDate|before_or_equal:' . now()->format('Y-m-d'),
            'fromDate' => 'required|date_format:Y-m-d|before_or_equal:toDate|before_or_equal:' . now()->format('Y-m-d'),
            'selectedEmail' => 'required',
            'selectedLocation' => 'required',
            // Add any other form field validations here
        ], [
            'toDate.required' => 'To Date is required.',
            'fromDate.required' => 'From Date is required.',
            'toDate.date_format' => 'Invalid format for To Date. Use YYYY-MM-DD format.',
            'fromDate.date_format' => 'Invalid format for From Date. Use YYYY-MM-DD format.',
            'toDate.after_or_equal' => 'To Date must be after or equal to From Date.',
            'fromDate.before_or_equal' => 'From Date must be before or equal to To Date and current date.',
        ], $successMessage);

        $defaultLocation = $request->input('selectedLocation');
        $defaultEmail = $request->input('selectedEmail');
        $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('fromDate'));
        $toDate = Carbon::createFromFormat('Y-m-d', $request->input('toDate'));

        $query = Login::query();

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        if ($defaultEmail) {
            $query->where('email_id', '=', $defaultEmail);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween(DB::raw('Date(created_at)'), [$fromDate->toDateString(), $toDate->toDateString()]);
        }

        $query->orderBy('created_at', 'asc');

        $results = $query->get();

        return response()->json(['results' => $results]);
    }
}
