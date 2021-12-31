<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function beacon () {
        return $this->belongsTo(Beacon::class);
    }

    public function port () {
        return $this->belongsTo(Port::class);
    }

    public function activity () {
        return $this->belongsTo(Activity::class);
    }


}
