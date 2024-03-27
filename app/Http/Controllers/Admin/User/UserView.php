<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class UserView extends Controller
{
    public function create()
    {
        $location = User::select('location')->distinct()->get();

        return response()->json(['locations' => $location]);
    }

    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();
        return response()->json(['user' => $user]);
    }

    public function update(Request $request, string $id)
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
                'userName' => 'required|string|unique:users,username,' . $id . ',id',
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
                'mobile' => 'required|integer|unique:users,mobile_number,' . $id . ',id',
                'selectedLocation' => 'required',
                'department' => 'required',
                'role' => 'required',
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
    
            $empName = ucwords($request->empName);
            $user = User::findOrFail($id);

            if (!Hash::check($request->input('password'), $user->password)) {
                $password = Hash::make($request->input('password'));
            } else {
                $password = $request->password;
            }

            $user->update([
                'employee_name' =>  $empName,
                'username' => $request->userName,
                'password' => $password,
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

            return response()->json(['message' => 'User has been updated successfully']);
        
    }

    public function store(Request $request)
    {
        // dd($request);
        $customValidation = [

            'selectedLocation.required' => 'Location is required.',

            'user.required' => 'User is required.',



            // Add other custom messages as needed

        ];

        // try {
        $request->validate([
            'user' => 'required|string|max:100',
            'selectedLocation' => 'required|string',
        ], $customValidation);

        $user = $request->input('user');
        $defaultLocation = $request->input('selectedLocation');
        $query = User::query();

        if ($user) {
            $query->where('user_status', '=', $user);
        }

        if ($defaultLocation) {
            $query->where('location', '=', $defaultLocation);
        }

        $results = $query->get();

        return response()->json(['results' => $results]);
        // } catch (ValidationException $e) {
        //     return response()->json(['errors' => $e->errors()], 422);
        // }
    }

    public function destroy(string $id)
    {
        User::destroy($id);
        return response()->json(['message' => 'User has been deleted successfully']);
    }
}
