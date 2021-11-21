<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    public function city () {
        return $this->belongsTo(City::class);
    }

    public function barques () {
        return $this->hasMany(Barque::class);
    }
}
