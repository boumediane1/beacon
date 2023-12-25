<?php

namespace App\Imports;

use App\Models\Beacon;
use App\Models\Manufacturer;
use App\Models\Model;
use App\Models\Status;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BeaconImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $status = Status::query()->where('name', $row['beacon_status'])->first();
        $manufacturer = Manufacturer::query()->where('name', $row['manufacturer'])->first();
        $model = Model::query()->where('name', 'MT410G')->first();
        $registration_status = Model::query()->where('name', $row['registration_status'])->first();

            return new Beacon([
                'uin' => $row['uin'],
                'serial_number_manufacturer' => $row['serial_number_manufacturer'],
                'serial_number_sar' => $row['serial_number_sar'],
                'registration_date' => $row['registration_date'] ? $this->transformDate($row['registration_date']) : Carbon::now()->toDateString(),
                'expiration_date' => $row['battery_expiration_date'] ? $this->transformDate($row['battery_expiration_date']) : Carbon::now()->addYears(7)->toDateString(),
                'manufacturer_id' => $manufacturer->id ?? 1,
                'type_id' => $model->type->id ?? 1,
                'model_id' => $model->id ?? 1,
                'registration_status_id' => $registration_status->id ?? 1,
                'status_id' => $status->id ?? 1,
                'tac' => $row['tac']
            ]);
    }

    public function uniqueBy()
    {
        return 'uin';
    }

    private function transformDate ($value) {
        return Carbon::instance(Date::excelToDateTimeObject($value));
    }
}
