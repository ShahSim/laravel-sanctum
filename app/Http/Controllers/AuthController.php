<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login()
    {
        return response()->json('This is login');
    }

    public function register()
    {
        return response()->json('This is register');
    }

    public function logout()
    {
        return response()->json('This is logout');
    }
}
