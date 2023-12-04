<?php

namespace App\Http\Controllers;

use App\Exports\VesselsExport;
use App\Http\Requests\StoreVesselRequest;
use App\Http\Requests\UpdateVesselRequest;
use App\Imports\BeaconImport;
use App\Imports\UsersImport;
use App\Imports\VesselImport;
use App\Models\Activity;
use App\Models\Beacon;
use App\Models\City;
use App\Models\Port;
use App\Models\RegistrationStatus;
use App\Models\Type;
use App\Models\UnitType;
use App\Models\User;
use App\Models\Vessel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class VesselController extends Controller
{
    public function index (Request $request) {
        $vessels = Vessel::query()
            ->with('user', 'beacon', 'port.city', 'activity')
            ->when($request->input('search'), function (Builder $query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
                $query->orWhere('mmsi', 'like', '%' . $search . '%');
                $query->orWhereRelation('user', 'name', 'like', '%' . $search . '%');
                $query->orWhereRelation('port', 'name', 'like', '%'. $search . '%');
                $query->orWhereRelation('beacon', 'uin', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(8);
        return Inertia::render('Vessel/Index', [
            'vessels' => $vessels,
            'can' => [
                'create' => Auth::user()->role === 1,
                'update' => Auth::user()->role === 1,
                'delete' => Auth::user()->role === 1,
                'import' => Auth::user()->role === 1
            ]
        ]);
    }

    public function show (Vessel $vessel) {
        $vessel = $vessel->load('unitType', 'user', 'beacon.registrationStatus', 'beacon.status');

        $types = Type::all()->map(function ($type) use ($vessel) {
            $temp = ['type' => ['name' => $type->name, 'selected' => false]];

            if ($type->name === $vessel->beacon->type->name) {
                $temp['type']['selected'] = true;
            }

            return $temp;
        });

        $registration_statuses = RegistrationStatus::all()->map(function ($status) use ($vessel) {
            $temp = ['status' => ['name' => $status->name, 'selected' => false]];

            if ($status->name === $vessel->beacon->registrationStatus->name) {
                $temp['status']['selected'] = true;
                return $temp;
            }

            return $temp;
        });

        $uin_arr = array_map(function ($c) {
            return '[' . $c . '] ';
        }, str_split($vessel->beacon->uin));

        $uin = join($uin_arr);

        $pdf = PDF::loadView('summary', compact('vessel', 'types', 'registration_statuses', 'uin'));

        return $pdf->stream($vessel->name . '.pdf');
    }

    public function create () {
        Gate::authorize('create', Vessel::class);
        $users = User::query()
            //->doesntHave('vessels')
            ->where('role', 3)
            ->get();
        $beacons = Beacon::query()
            //->doesntHave('vessels')
            ->get();
        $cities = City::query()->orderBy('name')->get();
        $ports = Port::query()->orderBy('name')->get();
        $activities = Activity::with('unitTypes')->get();
        $unit_types = UnitType::query()->orderBy('name')->get();

        return Inertia::render('Vessel/Create', [
            'cities' => $cities,
            'ports' => $ports,
            'activities' => $activities,
            'unitTypes' => $unit_types,
            'users' => $users,
            'beacons' => $beacons
        ]);
    }

    public function store (StoreVesselRequest $request) {
        Gate::authorize('create', Vessel::class);
        Vessel::create($request->except('city_id'));
        return Redirect::route('vessels.index');
    }

    public function edit (Vessel $vessel) {
        Gate::authorize('update', $vessel);
        $vessel->load('port');
        $cities = City::all();
        $ports = Port::all();
        $activities = Activity::all();
        $unit_types = UnitType::query()->orderBy('name')->get();
        $users = User::query()
            ->where('role', 3)
            ->get();
        $beacons = Beacon::all();
        return Inertia::render('Vessel/Edit', [
            'vessel' => $vessel,
            'cities' => $cities,
            'ports' => $ports,
            'activities' => $activities,
            'unitTypes' => $unit_types,
            'users' => $users,
            'beacons' => $beacons
        ]);
    }

    public function update (UpdateVesselRequest $request, Vessel $vessel) {
        Gate::authorize('update', $vessel);
        $vessel->update($request->except('city_id'));
        return Redirect::route('vessels.index');
    }

    public function destroy (Vessel $vessel) {
        Gate::authorize('delete', $vessel);
        $vessel->delete();
        return Redirect::route('vessels.index');
    }

    public function export () {
        return Excel::download(new VesselsExport(), 'vessels.xlsx');
    }

    public function import (Request $request) {
//        $request->validate([
//            'file' => 'mimes:application/vnd.ms-excel'
//        ]);
        Excel::import(new UsersImport(), $request->file('file'));
        Excel::import(new BeaconImport(), $request->file('file'));
        Excel::import(new VesselImport(), $request->file('file'));
        return 'Done!';
    }
}
