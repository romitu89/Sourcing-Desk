<?php

namespace App\Http\Controllers\Admin\UserMIS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Recruiter extends Controller
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
        $successMessage = [

            'employeeName.required' => 'Employee Name is required.',
            'employeeEmail.required' => 'Employee Email is required.',
            'selectedMatrix.required' => 'Matrix is required.',
            'fromDate.required' => 'From Date is required.',
            'toDate.required' => 'To Date is required.',
        ];
        // Validate the form data
        $request->validate([
            'employeeName' => 'required',
            'employeeEmail' => 'required',
            'selectedMatrix' => 'required',
            'toDate' => 'required|date_format:Y-m-d|after_or_equal:fromDate|before_or_equal:' . now()->format('Y-m-d'),
            'fromDate' => 'required|date_format:Y-m-d|before_or_equal:toDate|before_or_equal:' . now()->format('Y-m-d'),
        ], [
            'toDate.required' => 'To Date is required.',
            'fromDate.required' => 'From Date is required.',
            'toDate.date_format' => 'Invalid format for To Date. Use YYYY-MM-DD format.',
            'fromDate.date_format' => 'Invalid format for From Date. Use YYYY-MM-DD format.',
            'toDate.after_or_equal' => 'To Date must be after or equal to From Date.',
            'fromDate.before_or_equal' => 'From Date must be before or equal to To Date and current date.',
        ], $successMessage);

        $employeeName = $request->input('employeeName');
        $employeeEmail = $request->input('employeeEmail');
        $fromDate = Carbon::createFromFormat('Y-m-d', $request->input('fromDate'));
        $toDate = Carbon::createFromFormat('Y-m-d', $request->input('toDate'));

        $query = User::query();

        if ($employeeName) {
            $query->where('employee_name', '=', $employeeName);
        }

        if ($employeeEmail) {
            $query->where('email_id', '=', $employeeEmail);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween(DB::raw('Date(created_at)'), [$fromDate->toDateString(), $toDate->toDateString()]);
        }


        $results = $query->get();

        return Response::json(['results' => $results]);
    }
}
