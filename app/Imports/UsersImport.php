<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UsersImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function model(array $row)
    {
        if ($row['owner'] && $row['phone_number']) {
            return new User([
                'name' => $row['owner'],
                'email' => $row['email'],
                'phone_number' => $row['phone_number'],
                'secondary_phone_number' => $row['secondary_phone_number'],
                'address' => $row['address'],
                'emergency_contact_name' => $row['emergency_contact_name'],
                'emergency_contact_phone_number' => $row['emergency_contact_phone_number'],
                'secondary_emergency_contact_name' => $row['secondary_emergency_contact_name'],
                'secondary_emergency_contact_phone_number' => $row['secondary_emergency_contact_phone_number']
            ]);
        }
    }

    public function uniqueBy()
    {
        return 'name';
    }


}
