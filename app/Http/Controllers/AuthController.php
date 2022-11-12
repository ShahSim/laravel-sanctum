<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Traits\HttpResponses;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login()
    {
        return response()->json('This is login');
    }

    public function register(StoreUserRequest $request)
    {
        $validated = $request->validated();

        return $validated;
    }

    public function logout()
    {
        return response()->json('This is logout');
    }
}
