<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBeaconRequest;
use App\Http\Requests\UpdateBeaconRequest;
use App\Imports\BeaconImport;
use App\Models\Beacon;
use App\Models\Manufacturer;
use App\Models\Model;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class BeaconController extends Controller
{
    public function index (Request $request) {
        $beacons = Beacon::query()
            ->with('model.type', 'manufacturer', 'status')
            ->when($request->input('search'), function (Builder $query, $search) {
                $query->where('uin', 'like', '%' . $search . '%');
                $query->orWhere('serial_number', 'like', '%' . $search . '%');
            })
            ->when($request->input('id'), function (Builder $query, $search) {
                return $query->where('id', $search);
            })
            ->latest()
            ->paginate(5);
        return Inertia::render('Beacon/Index', [
            'beacons' => $beacons,
            'can' => [
                'create' => Auth::user()->is_admin === 1,
                'update' => Auth::user()->is_admin === 1,
                'delete' => Auth::user()->is_admin === 1
            ]
        ]);
    }

    public function create () {
        Gate::authorize('create', Beacon::class);
        return Inertia::render('Beacon/Create', [
            'manufacturers' => Manufacturer::all(),
            'types' => Type::all(),
            'models' => Model::all(),
            'statuses' => Status::all()
        ]);
    }

    public function store (StoreBeaconRequest $request) {
        Gate::authorize('create', Beacon::class);
        Beacon::create($request->except('type_id'));
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
            'statuses' => Status::all()
        ]);
    }

    public function update (UpdateBeaconRequest $request, Beacon $beacon) {
        Gate::authorize('update', $beacon);
        $beacon->update($request->except('type_id'));
        return Redirect::route('beacons.index');
    }

    public function destroy (Beacon $beacon) {
        Gate::authorize('delete', $beacon);
        $beacon->delete();
        return Redirect::route('beacons.index');
    }
}
