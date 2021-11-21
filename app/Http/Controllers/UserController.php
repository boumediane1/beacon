<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index (Request $request) {

        $users = User::query()
            ->where('is_admin', 0)
            ->when($request->input('search'), function (Builder $query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($request->input('id'), function (Builder $query, $search) {
                return $query->where('id', $search);
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();
        return Inertia::render('User/Index', [
            'users' => $users
        ]);
    }
    public function create () {
        return Inertia::render('User/Create');
    }

    public function store (StoreUserRequest $request) {
        User::create($request->validated());
        return Redirect::route('users.index');
    }

    public function edit (User $user) {
        return Inertia::render('User/Edit', [
            'user' => $user
        ]);
    }

    public function update (UpdateUserRequest $request, User $user) {
        $user->update($request->validated());
        return Redirect::route('users.index');
    }

    public function destroy (User $user) {
        $user->delete();
        return Redirect::route('users.index');
    }
}
