<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    use HttpResponses;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout');
    }

    /**
     * Login existing user
     * @return json with sanctum API token
     */
    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::where('email', $request->email)->first();

        if ($user && $user->tokens->count() > 0) { $user->tokens()->delete(); }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error(null, 'Credentials don\'t match', 401);
        }

        $user = User::where('email', $request->email)->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken("API Token of {$user->email}")->plainTextToken
        ]);
    }

    /**
     * Register new user
     * @return json with sanctum API token
     */
    public function register(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken("API Token of {$user->name}")->plainTextToken
        ]);
    }

    /**
     * Delete current sanctum token to log out
     * @return json response
     */
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success(null, 'Successfully loged out, token deleted');
    }
}
