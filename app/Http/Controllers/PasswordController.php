<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function update (Request $request) {
        $validated = Validator::make($request->all(), [
            'current_password' => ['required', 'password'],
            'password' => ['required', 'confirmed'],
        ])->stopOnFirstFailure(true)->validate();


        $request->user()->update(array('password' => Hash::make($request->input('password'))));
    }
}
