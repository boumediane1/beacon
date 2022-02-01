<?php

namespace App\Imports;

use App\Models\Beacon;
use App\Models\Manufacturer;
use App\Models\Model;
use App\Models\Status;
use App\Models\Type;
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
        $model = Model::query()->where('name', $row['model'])->first();
            return new Beacon([
                'uin' => $row['uin'],
                'serial_number_manufacturer' => $row['serial_number_manufacturer'],
                'serial_number_sar' => $row['serial_number_sar'],
                'registration_date' => $row['registration_date'] ? $this->transformDate($row['registration_date']) : Carbon::now()->toDateString(),
                'expiration_date' => $row['battery_expiration_date'] ? $this->transformDate($row['battery_expiration_date']) : Carbon::now()->addYears(7)->toDateString(),
                'status_id' => $status->id ?? 1,
                'manufacturer_id' => $manufacturer->id ?? 1,
                'model_id' => $model->id ?? 1
            ]);
    }

    public function uniqueBy()
    {
        return 'uin';
    }

    private function transformDate ($value) {
        try {
            return Carbon::instance(Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat('Y-m-d', $value);
        }
    }
}
