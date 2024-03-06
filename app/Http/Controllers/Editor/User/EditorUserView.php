<?php

namespace App\Http\Controllers\Editor\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EditorUserView extends Controller
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

        $request->validate([
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
            'empId' => 'required|unique:users,employee_id,' . $id . ',id',
            'email' => 'required|email|max:255|unique:users,email_id,' . $id . ',id',
            'mobile' => 'required|integer|unique:users,mobile_number,' . $id . ',id',
            'selectedLocation' => 'required',
            'department' => 'required',
            'role' => 'required',

            'dob' => 'required'

        ]);

        $empName = ucwords($request->empName);
        // Check if the new password is different from the current password

        //dd($request->except('_token','_method'));
        $user = User::findOrFail($id);
        if (!Hash::check($request->input('password'), $user->password)) {
            // Update the user's password with the new bcrypt hash
            $password = Hash::make($request->input('password'));
        } else {
            $password = $request->password;
        }
        // Update the client with the validated data
        $user->update([
            'employee_name' =>  $empName,
            'username' => $request->userName,
            'password' => $password, // Encrypt the password
            'employee_id' => $request->empId,
            'mobile_number' => $request->mobile,
            'email_id' => $request->email,
            'location' => $request->selectedLocation,
            'department' => $request->department,
            'role' => $request->role,
            'reporting_to' => $request->selectedReport,
            'dob' => $request->dob,
        ]);
        return response()->json(['message' => 'User updated successfully']);
    }
    public function store(Request $request)
    {
        //dd($request->all());

        $customValidation = [

            'selectedLocation.required' => 'Location is required.',

            'user.required' => 'User is required.',



            // Add other custom messages as needed

        ];

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

        // Add more conditions as needed

        // Execute the query and retrieve the results
        $results = $query->get();

        return response()->json(['results' => $results]);
        //dd($results);
    }
    public function destroy(string $id)
    {
        User::deleted($id);
        return response()->json(['message' => 'User deleted successfully']);
    }
}
