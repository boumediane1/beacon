<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBeaconRequest;
use App\Http\Requests\UpdateBeaconRequest;
use App\Models\Beacon;
use App\Models\Manufacturer;
use App\Models\Model;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BeaconController extends Controller
{
    public function index (Request $request) {
        $beacons = Beacon::query()
            ->with('model.type', 'manufacturer')
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
            'beacons' => $beacons
        ]);
    }

    public function create () {
        return Inertia::render('Beacon/Create', [
            'manufacturers' => Manufacturer::all(),
            'types' => Type::all(),
            'models' => Model::all()
        ]);
    }

    public function store (StoreBeaconRequest $request) {
        Beacon::create($request->except('type_id'));
        return Redirect::route('beacons.index');
    }

    public function edit (Beacon $beacon) {
        $beacon->load('model');
        return Inertia::render('Beacon/Edit', [
            'beacon' => $beacon,
            'manufacturers' => Manufacturer::all(),
            'types' => Type::all(),
            'models' => Model::all()
        ]);
    }

    public function update (UpdateBeaconRequest $request, Beacon $beacon) {
        $beacon->update($request->except('type_id'));
        return Redirect::route('beacons.index');
    }

    public function destroy (Beacon $beacon) {
        $beacon->delete();
        return Redirect::route('beacons.index');
    }
}
