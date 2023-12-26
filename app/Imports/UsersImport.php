<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UsersImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function model(array $row)
    {
        $country = Country::query()->where('name', $row['country'])->first();
        $user = User::query()->where('name', $row['owner'])->first();

        if (!$user && $row['owner']) {
            return new User([
                'name' => $row['owner'],
                'email' => $row['email'],
                'phone_number' => $row['phone_number'],
                'secondary_phone_number' => $row['secondary_phone_number'],
                'country_id' => $country->id ?? 1,
                'cin' => $row['cin'],
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
