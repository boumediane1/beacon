<?php

namespace App\Http\Controllers;

use App\Exports\VesselsExport;
use App\Http\Requests\StoreVesselRequest;
use App\Http\Requests\UpdateVesselRequest;
use App\Imports\BeaconImport;
use App\Models\Activity;
use App\Models\Vessel;
use App\Models\Beacon;
use App\Models\City;
use App\Models\Port;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
                $query->whereRelation('user', 'name', 'like', '%' . $search . '%');
                $query->orWhereRelation('port', 'name', 'like', '%'. $search . '%');
                $query->orWhereRelation('beacon', 'uin', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(5);
        return Inertia::render('Vessel/Index', [
            'vessels' => $vessels,
            'can' => [
                'create' => Auth::user()->is_admin === 1,
                'update' => Auth::user()->is_admin === 1,
                'delete' => Auth::user()->is_admin === 1
            ]
        ]);
    }

    public function show (Vessel $vessel) {
        $vessel = $vessel->load('user', 'beacon');
        $pdf = PDF::loadView('summary', compact('vessel'));
        return $pdf->stream();
    }

    public function create () {
        Gate::authorize('create', Vessel::class);
        $users = User::query()
            //->doesntHave('vessels')
            ->where('is_admin', 0)
            ->get();
        $beacons = Beacon::query()
            //->doesntHave('vessels')
            ->get();
        $cities = City::query()->orderBy('name')->get();
        $ports = Port::query()->orderBy('name')->get();
        $activities = Activity::all();

        return Inertia::render('Vessel/Create', [
            'cities' => $cities,
            'ports' => $ports,
            'activities' => $activities,
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
        $users = User::query()
            ->where('is_admin', 0)
            ->get();
        $beacons = Beacon::all();
        return Inertia::render('Vessel/Edit', [
            'vessel' => $vessel,
            'cities' => $cities,
            'ports' => $ports,
            'activities' => $activities,
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
}
