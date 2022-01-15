<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileInformationController extends Controller
{
    public function update (Request $request) {
        $request->user()->update($request->validate([
            'username' => ['required', 'min:3', 'regex:/^\S*$/u', Rule::unique('users')->ignore($request->user()->id)]
        ]));
    }
}
