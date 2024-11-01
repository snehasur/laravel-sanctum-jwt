<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6|confirmed',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    return response()->json(['message' => 'User registered successfully'], 200);
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|string|email',
      'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Create token
    $token = $user->createToken('MyAppToken')->plainTextToken;

    return response()->json(['token' => $token], 200);
  }

  public function profile(Request $request)
  {
    return response()->json($request->user());
  }
}
