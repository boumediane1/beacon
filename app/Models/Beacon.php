<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PHPUnit\Runner\BaseTestRunner;

class Beacon extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['usage'];

    protected $casts = [
        'usage' => 'integer'
    ];

    public function model () {
        return $this->belongsTo(Model::class);
    }

    public function manufacturer () {
        return $this->belongsTo(Manufacturer::class);
    }

    public function barques () {
        return $this->hasMany(Barque::class);
    }

    public function getUsageAttribute () {
        $from = (int) Carbon::createFromFormat('Y-m-d', $this->registration_date)->format('Y');
        $to = (int) Carbon::createFromFormat('Y-m-d', $this->expiration_date)->format('Y');
        return round(($to - $from) * 100 / 7);
    }
}
