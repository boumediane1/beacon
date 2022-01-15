<?php

namespace App\Imports;

use App\Models\Beacon;
use App\Models\Status;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BeaconImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $status = Status::query()->where('name', $row['beacon_status'])->first();
        if ($row['beacon_hex_id'] && Beacon::query()->where('uin', $row['beacon_hex_id'])->doesntExist()) {
            return new Beacon([
                'uin' => $row['beacon_hex_id'],
                'serial_number_manufacturer' => $row['serial_number_manufacturer'],
                'serial_number_sar' => $row['serial_number_sar'],
                'registration_date' => '2021-03-01',
                'expiration_date' => '2028-03-01',
                'status_id' => $status->id,
                'manufacturer_id' => 1,
                'model_id' => 1
            ]);
        }
    }
}
