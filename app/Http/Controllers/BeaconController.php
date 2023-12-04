<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBeaconRequest;
use App\Http\Requests\UpdateBeaconRequest;
use App\Models\Beacon;
use App\Models\Manufacturer;
use App\Models\Model;
use App\Models\RegistrationStatus;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BeaconController extends Controller
{
    public function index (Request $request) {
        $beacons = Beacon::query()
            ->with('type', 'model', 'manufacturer', 'status')
            ->when($request->input('search'), function (Builder $query, $search) {
                $query->where('serial_number_sar', 'like', '%' . $search . '%');
                $query->orWhere('serial_number_manufacturer', 'like', '%' . $search . '%');
                $query->orWhere('uin', 'like', '%' . $search . '%');
            })
            ->when($request->input('id'), function (Builder $query, $search) {
                return $query->where('id', $search);
            })
            ->latest()
            ->paginate(8);
        return Inertia::render('Beacon/Index', [
            'beacons' => $beacons,
            'can' => [
                'create' => Auth::user()->role === 1,
                'update' => Auth::user()->role === 1,
                'delete' => Auth::user()->role === 1
            ]
        ]);
    }

    public function create () {
        Gate::authorize('create', Beacon::class);
        return Inertia::render('Beacon/Create', [
            'manufacturers' => Manufacturer::all(),
            'types' => Type::all(),
            'models' => Model::all(),
            'statuses' => Status::all(),
            'registrationStatuses' => RegistrationStatus::all()
        ]);
    }

    public function store (StoreBeaconRequest $request) {
        Gate::authorize('create', Beacon::class);
        Beacon::create($request->validated());
        return Redirect::route('beacons.index');
    }

    public function edit (Beacon $beacon) {
        Gate::authorize('update', $beacon);
        $beacon->load('model');
        return Inertia::render('Beacon/Edit', [
            'beacon' => $beacon,
            'manufacturers' => Manufacturer::all(),
            'types' => Type::all(),
            'models' => Model::all(),
            'statuses' => Status::all(),
            'registrationStatuses' => RegistrationStatus::all()
        ]);
    }

    public function update (UpdateBeaconRequest $request, Beacon $beacon) {
        Gate::authorize('update', $beacon);
        $beacon->update($request->validated());
        return Redirect::route('beacons.index');
    }

    public function destroy (Beacon $beacon) {
        Gate::authorize('delete', $beacon);
        $beacon->delete();
        return Redirect::route('beacons.index');
    }
}
