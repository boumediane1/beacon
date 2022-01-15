<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;


class StaffController extends Controller
{

    public function index (Request $request) {
        Gate::authorize('viewAny', User::class);

        $users = User::query()
            ->where('role', 2)
            ->when($request->input('search'), function (Builder $query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(5);
        return Inertia::render('Staff/Index', [
            'users' => $users
        ]);
    }

    public function create () {
        Gate::authorize('create', User::class);
        return Inertia::render('Staff/Create');
    }

    public function store (StoreStaffRequest $request) {
        Gate::authorize('create', User::class);
        User::create($request->validated() + ['role' => 2]);
        return Redirect::route('staff.index');
    }

    public function edit ($id) {
        $user = User::query()->findOrFail($id);
        Gate::authorize('update', $user);
        return Inertia::render('Staff/Edit', [
            'user' => $user
        ]);
    }

    public function update (Request $request, $id) {
        $user = User::query()->findOrFail($id);
        Gate::authorize('update', $user);
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'min:2', Rule::unique('users')->ignore($id)],
            'username' => ['required', 'min:2', 'regex:/^\S*$/u', Rule::unique('users')->ignore($id)],
            'password' => ['sometimes', 'min:2'],
            'status' => ['required']
        ])->stopOnFirstFailure(true)->validate();

        if ($request->input('password')) {
            $user->update($request->except('password') + ['password' => Hash::make($request->input('password'))]);
        } else {
            $user->update($request->all());
        }

        return Redirect::route('staff.index');
    }

    public function destroy ($id) {
        $user = User::query()->findOrFail($id);
        Gate::authorize('delete', $user);
        $user->delete();
        return Redirect::route('users.index');
    }
}
