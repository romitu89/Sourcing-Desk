<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        try {
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
                'dob' => 'required',
            ]);

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
                'reporting_to' => $request->selectedReport,
                'dob' => $request->dob,
            ]);

            return response()->json(['message' => 'User has been updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function store(Request $request)
    {
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
            $defaultLocation = $request->input('defaultLocation');
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
