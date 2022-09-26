<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index (Request $request) {

        $users = User::query()
            ->where('role', 3)
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
            'users' => $users,
            'can' => [
                'create' => Auth::user()->role === 1,
                'update' => Auth::user()->role === 1,
                'delete' => Auth::user()->role === 1
            ]
        ]);
    }
    public function create () {
        Gate::authorize('create', User::class);
        return Inertia::render('User/Create', [
            'countries' => Country::all()
        ]);
    }

    public function store (StoreUserRequest $request) {
        Gate::authorize('create', User::class);
        User::create($request->validated());
        return Redirect::route('users.index');
    }

    public function edit (User $user) {
        Gate::authorize('update', $user);
        return Inertia::render('User/Edit', [
            'user' => $user,
            'countries' => Country::all()
        ]);
    }

    public function update (UpdateUserRequest $request, User $user) {
        Gate::authorize('update', $user);
        $user->update($request->validated());
        return Redirect::route('users.index');
    }

    public function destroy (User $user) {
        Gate::authorize('delete', $user);
        $user->delete();
        return Redirect::route('users.index');
    }
}
