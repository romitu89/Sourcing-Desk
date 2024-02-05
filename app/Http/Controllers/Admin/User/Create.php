<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Response; // Add this line
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use App\Models\User;

class Create extends Controller
{
    public function create()
    {
        $user = User::all();
        return response()->json($user);
        // return view('Admin/User/Create');
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
        // dd($request->all());

        $messages = [

            'empName.required' => 'Employee Name is required.',
    
            'userName.required' => 'Username is required.',
    
            'userName.unique' => 'The Username has already been taken.', // Example for customizing unique constraint message

            'cnfrmPassword.required' => 'Confirm password is required.',

            'cnfrmPassword.same' => 'The Confirm password field must match password.',
    
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
            'reporting_to' => $request->selectedReport,
            'dob' => $request->dob,
        ]);



        $user->save();
        // return redirect()->route('user-create')
        // ->with('success','User is Created');
        return response()->json(['message' => 'User is Created']);
    }
}
