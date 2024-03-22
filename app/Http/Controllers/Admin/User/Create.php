<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Response; // Add this line
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;

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
         
        return response()->json(['userAm' => $userAm,'userTl' => $userTl, 'locations' => $location]);    }
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
        // dd($request->all());

        $messages = [

            'empName.required' => 'Employee Name is required.',

            'userName.required' => 'Username is required.',

            'password.required' => 'Password is required.',

            'userName.unique' => 'The Username has already been taken.', // Example for customizing unique constraint message

            'cnfrmPassword.required' => 'Confirm Password is required.',

            'cnfrmPassword.same' => 'The Confirm password field must match password.',

            'empId.required' => 'Employee Id is required.',

            'email.required' => 'Email is required.',

            'mobile.required' => 'Mobile is required.',

            'selectedLocation.required' => 'Location is required.',

            'department.required' => 'Department is required.',

            'role.required' => 'Role is required.',

            'dob.required' => 'Date Of Birth is required.',

            // Add other custom messages as needed

        ];


        $request->validate([
            'empName' => 'required|string|max:100',
            'userName' => 'required|string|unique:users,username',
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
            'empId' => 'required|unique:users,employee_id',
            'email' => 'required|email|max:255|unique:users,email_id',
            'mobile' => 'required|integer|unique:users,mobile_number',
            'selectedLocation' => 'required',
            'department' => 'required',
            'role' => 'required',

            'dob' => 'required'

        ], $messages);
        $rules = [
            'role' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->after(function ($validator) use ($request) {
            if ($request->role == 'recruiter' && !$request->filled(['selectedReportAM', 'selectedReportTL'])) {
                // Add a custom error message
                $validator->errors()->add('selectedReportAM', 'When role is recruiter, either selectedReportAM or selectedReportTL must be selected.');
            }
        });
  
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $empName = ucwords($request->empName);

        $user = new User([

            'employee_name' =>  $empName,
            'username' => $request->userName,
            'password' => bcrypt($request->password), // Encrypt the password
            'employee_id' => $request->empId,
            'mobile_number' => $request->mobile,
            'email_id' => $request->email,
            'location' => $request->selectedLocation,
            'department' => $request->department,
            'role' => $request->role,
            'reporting_to_am' => $request->selectedReportAM,
            'reporting_to_tl' => $request->selectedReportTL,
            'dob' => $request->dob,
        ]);



        $user->save();
        // return redirect()->route('user-create')
        // ->with('success','User is Created');
        return response()->json(['message' => 'User is Created']);
    }
}
