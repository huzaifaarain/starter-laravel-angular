<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function login()
    {
        return true;
    }

    public function store(Request $request)
    {
        Log::debug('storing');

        $user = new User($request->all());

        if (!$user->save()) {
            abort(500, 'Could not save user.');
        }

        $user['token'] = JWTAuth::fromUser($user);
        return $user;
    }

    public function show($id)
    {
        return User::find($id);
    }
}