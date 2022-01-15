<?php

namespace App\Imports;

use App\Models\Activity;
use App\Models\User;
use App\Models\Vessel;
use App\Models\Beacon;
use App\Models\Port;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VesselImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (Vessel::query()->where('registration_number', $row['registration_number'])->doesntExist()) {
            $user = User::query()->where('name', $row['owner'])->first();
            $beacon = Beacon::query()->where('uin', $row['beacon_hex_id'])->first();
            $port = Port::query()->where('name', $row['port'])->first();
            $activity = Activity::query()->where('name', $row['activity_type'])->first();
            return new Vessel([
                'name' => $row['unit_name'],
                'registration_number' => $row['registration_number'],
                'port_id' => $port->id,
                'beacon_id' => $beacon->id,
                'user_id' => $user->id ?? NULL,
                'activity_id' => $activity->id
            ]);
        }
    }
}
