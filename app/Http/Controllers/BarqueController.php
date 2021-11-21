<?php

namespace App\Http\Controllers;

use App\Exports\BarquesExport;
use App\Http\Requests\StoreBarqueRequest;
use App\Http\Requests\UpdateBarqueRequest;
use App\Models\Activity;
use App\Models\Barque;
use App\Models\Beacon;
use App\Models\City;
use App\Models\Port;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class BarqueController extends Controller
{
    public function index (Request $request) {
        $barques = Barque::query()
            ->with('user', 'beacon', 'port.city', 'activity')
            ->when($request->input('search'), function (Builder $query, $search) {
                $query->whereRelation('user', 'name', 'like', '%' . $search . '%');
                $query->orWhereRelation('port', 'name', 'like', '%'. $search . '%');
                $query->orWhereRelation('beacon', 'uin', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(5);
        return Inertia::render('Barque/Index', [
            'barques' => $barques
        ]);
    }

    public function create () {
        $users = User::query()
            //->doesntHave('barques')
            ->where('is_admin', 0)
            ->get();
        $beacons = Beacon::query()
            //->doesntHave('barques')
            ->get();
        $cities = City::all();
        $ports = Port::all();
        $activities = Activity::all();

        return Inertia::render('Barque/Create', [
            'cities' => $cities,
            'ports' => $ports,
            'activities' => $activities,
            'users' => $users,
            'beacons' => $beacons
        ]);
    }

    public function store (StoreBarqueRequest $request) {
        Barque::create($request->except('city_id'));
        return Redirect::route('barques.index');
    }

    public function edit (Barque $barque) {
        $barque->load('port');
        $cities = City::all();
        $ports = Port::all();
        $activities = Activity::all();
        $users = User::query()
            ->where('is_admin', 0)
            ->get();
        $beacons = Beacon::all();
        return Inertia::render('Barque/Edit', [
            'barque' => $barque,
            'cities' => $cities,
            'ports' => $ports,
            'activities' => $activities,
            'users' => $users,
            'beacons' => $beacons
        ]);
    }

    public function update (UpdateBarqueRequest $request, Barque $barque) {
        $barque->update($request->except('city_id'));
        return Redirect::route('barques.index');
    }

    public function destroy (Barque $barque) {
        $barque->delete();
        return Redirect::route('barques.index');
    }

    public function export () {
        return Excel::download(new BarquesExport(), 'barques.xlsx');
    }
}
