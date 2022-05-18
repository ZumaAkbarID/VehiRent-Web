<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booked extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function vehicleSpec()
    {
        return $this->belongsToMany(VehicleSpec::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}