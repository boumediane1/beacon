<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    public function show () {
        return Inertia::render('Profile/Show', [
            'user' => Auth::user()
        ]);
    }
}
