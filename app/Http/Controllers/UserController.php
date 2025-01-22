<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    //User registration methods
    public function register(Request $request)
    {
        //Validate the incoming request using the validate method
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|integer'
        ]);

        $data = $request->only(['name', 'email', 'role']);
        $data['password'] = Hash::make($request->password);

        // dd($data);
        // Log::info('Request Data: ', $data);

        $user = User::create($data);
        // Log::info('User Created: ', $user->toArray());
        // Creating Sanctum token for the registered user
        $plainTextToken = $user->createToken('UserRegister')->plainTextToken;
        $token = explode('|', $plainTextToken)[1];

        return response()->json(['token' => $token,'message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $plainTextToken = $user->createToken('UserLogin')->plainTextToken;
        $token = explode('|', $plainTextToken)[1];

        return response()->json(['token' => $token,'message' => 'User login successfull', 'user_id' => $user->id, 'user' => $user], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function show(Request $request)
    {
        $user = $request->user(); // Get the authenticated admin

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }

    public function list(Request $request)
    {
        // Fetch paginated admins
        $users = User::select('id', 'name', 'email', 'role', 'created_at', 'updated_at')
        ->paginate(10); // 10 admins per page

        return response()->json(['users' => $users], 200);
    }
}
