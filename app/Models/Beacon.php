<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beacon extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['usage'];

    protected $casts = [
        'usage' => 'integer'
    ];

    public function type () {
        return $this->belongsTo(Type::class);
    }

    public function model () {
        return $this->belongsTo(Model::class);
    }

    public function manufacturer () {
        return $this->belongsTo(Manufacturer::class);
    }

    public function vessels () {
        return $this->hasMany(Vessel::class);
    }

    public function status () {
        return $this->belongsTo(Status::class);
    }

    public function registrationStatus () {
        return $this->belongsTo(RegistrationStatus::class);
    }

    public function getUsageAttribute () {
        $from = (int) Carbon::createFromFormat('Y-m-d', $this->registration_date)->format('Y');
        $to = (int) Carbon::createFromFormat('Y-m-d', $this->expiration_date)->format('Y');
        return round(($to - $from) * 100 / 7);
    }
}
