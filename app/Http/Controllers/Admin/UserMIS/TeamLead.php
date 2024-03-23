<?php

namespace App\Http\Controllers\Admin\UserMIS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\User;

class TeamLead extends Controller
{
    public function create()
    {

        $user = User::select('employee_name', 'email_id')->get();

        return response()->json([
            'User' => $user,


        ]);
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'employeeName' => 'required',
            'employeeEmail' => 'required',
            'selectedMatrix' => 'required',
            'fromDate' => 'required|date',
            'toDate' => 'required|date',
        ]);

        $employeeName = $request->input('employeeName');
        $employeeEmail = $request->input('employeeEmail');

        $query = User::query();

        if ($employeeName) {
            $query->where('employee_name', '=', $employeeName);
        }

        if ($employeeEmail) {
            $query->where('email_id', '=', $employeeEmail);
        }


        $results = $query->get();

        return Response::json(['results' => $results]);
    }
}
