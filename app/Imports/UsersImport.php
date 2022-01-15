<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['owner'] && $row['phone_number'] && User::query()->where('name', $row['owner'])->doesntExist()) {
            return new User([
                'name' => $row['owner'],
                'email' => $row['email'],
                'phone_number' => $row['phone_number'],
                'secondary_phone_number' => $row['secondary_phone_number'],
                'emergency_contact_name' => $row['emergency_contact_name'],
                'emergency_contact_phone_number' => $row['emergency_contact_phone_number'],
                'secondary_emergency_contact_name' => $row['secondary_emergency_contact_name'],
                'secondary_emergency_contact_phone_number' => $row['secondary_emergency_contact_phone_number']
            ]);
        }
    }
}
