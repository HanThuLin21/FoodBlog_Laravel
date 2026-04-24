<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;

class AuthController extends Controller
{
    public function userRegister(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
            'conpass' => 'required|same:password',
        ]);

        $user = User::create([
            'user_name' => $validated['username'],
            'user_email' => $validated['email'],
            'user_phone' => $validated['phone'],
            'user_pass' => $validated['password'],
            'user_conpass' => $validated['conpass'],
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ]);
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('user_email', $request->email)
                    ->where('user_pass', $request->password)
                    ->first();

        if ($user) {
            return response()->json([
                'message' => 'Login successful',
                'user' => $user
            ]);
        }

        return response()->json(['message' => 'Invalid email or password'], 401);
    }

    public function adminRegister(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'conpassword' => 'required|same:password',
        ]);

        $admin = Admin::create([
            'admin_name' => $validated['username'],
            'admin_email' => $validated['email'],
            'admin_pass' => $validated['password'],
            'admin_conpass' => $validated['conpassword'],
        ]);

        return response()->json([
            'message' => 'Admin registered successfully',
            'admin' => $admin
        ]);
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('admin_email', $request->email)
                      ->where('admin_pass', $request->password)
                      ->first();

        if ($admin) {
            return response()->json([
                'message' => 'Login successful',
                'admin' => $admin
            ]);
        }

        return response()->json(['message' => 'Invalid email or password'], 401);
    }
}
