<?php

namespace App\Imports;

use App\Models\Activity;
 use App\Models\UnitType;
use App\Models\User;
use App\Models\Vessel;
use App\Models\Beacon;
use App\Models\Port;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class VesselImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::query()->where('name', $row['owner'])->first();
        $beacon = Beacon::query()->where('uin', $row['uin'])->first();
        $port = Port::query()->where('name', $row['port'])->first();
        $activity = Activity::query()->where('name', $row['activity_type'])->first();
        $unit_type = UnitType::query()->where('name', $row['unit_type'])->first();

        return new Vessel([
            'registration_number' => $row['registration_number'],
            'name' => $row['unit_name'],
            'port_id' => $port->id,
            'beacon_id' => $beacon->id,
            'user_id' => $user->id ?? null,
            'activity_id' => $activity->id ?? 1,
            'mmsi' => $row['mmsi'],
            'unit_type_id' => $unit_type->id ?? null
        ]);
    }

    public function uniqueBy()
    {
        return 'registration_number';
    }
}
