<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Response; // Add this line
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Create extends Controller
{
    public function create()
    {
        $location = Location::select('country')->distinct()->get();

        $userAm = User::select('email_id')
            ->distinct()
            ->where('role', 'accountManager')
            ->get();
        $userTl = User::select('email_id')
            ->distinct()
            ->where('role', 'teamLead')
            ->get();

        return response()->json(['userAm' => $userAm, 'userTl' => $userTl, 'locations' => $location]);
    }
    public function getreporting($role)
    {
        if ($role == 'teamLead') {

            $user = User::where('role', 'accountManager')
                ->pluck('email_id');
            return response()->json($user);
        } else {
            $roles = ['accountManager', 'teamLead'];
            $user = User::whereIn('role', $roles)
                ->pluck('email_id');
            return response()->json($user);
        }
    }
    public function store(Request $request)
    {
        $messages = [
            'empName.required' => 'Employee Name is required.',
            'userName.required' => 'Username is required.',
            'userName.regex' => 'The Username cannot contain spaces.',
            'password.required' => 'Password is required.',
            'userName.unique' => 'The Username has already been taken.',
            'cnfrmPassword.required' => 'Confirm Password is required.',
            'cnfrmPassword.same' => 'The Confirm password field must match the password.',
            'empId.required' => 'Employee Id is required.',
            'empId.regex' => 'The Employee Id cannot contain spaces.',
            'email.required' => 'Email is required.',
            'mobile.required' => 'Mobile is required.',
            'mobile.regex' => 'The Mobile Number cannot contain spaces.',
            'selectedLocation.required' => 'Location is required.',
            'department.required' => 'Department is required.',
            'role.required' => 'Role is required.',
            'dob.required' => 'Date Of Birth is required.',
        ];

        $rules = [
            'empName' => 'required|string|max:100',
            'userName' => 'required|string|unique:users,username|regex:/^\S*$/u',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'cnfrmPassword' => 'required|same:password',
            'empId' => 'required|unique:users,employee_id|regex:/^\S*$/u',
            'email' => 'required|email|max:255|unique:users,email_id',
            'mobile' => 'required|numeric|unique:users,mobile_number|regex:/^\S*$/u',
            'selectedLocation' => 'required',
            'department' => 'required',
            'role' => 'required',
            'dob' => 'required|date|before:today',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator) use ($request) {
            if ($request->role == 'recruiter' && !$request->filled('selectedReportAM') && !$request->filled('selectedReportTL')) {
                $validator->errors()->add('selectedReportAM', 'When role is recruiter, either Select AM or TL must be selected.');
            }
            if ($request->role == 'teamLead' && !$request->filled('selectedReportAM')) {
                $validator->errors()->add('selectedReportAM', 'When role is Team-Lead, AM must be selected.');
            }
        });

        if ($validator->fails()) {
            $errors = $validator->errors();
            $customErrors = $errors->messages();

            return response()->json(['errors' => $customErrors], 422);
        }

        $user = new User([
            'employee_name' => ucwords($request->empName),
            'username' => $request->userName,
            'password' => Hash::make($request->password),
            'employee_id' => $request->empId,
            'email_id' => $request->email,
            'mobile_number' => $request->mobile,
            'location' => $request->selectedLocation,
            'department' => $request->department,
            'role' => $request->role,
            'reporting_to_am' => $request->selectedReportAM,
            'reporting_to_tl' => $request->selectedReportTL,
            'dob' => $request->dob,
        ]);

        $user->save();

        return response()->json(['message' => 'User is Created'], 201);
    }
}
