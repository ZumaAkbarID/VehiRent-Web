<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vehicleSpec()
    {
        return $this->belongsTo(VehicleSpec::class, 'id_vehicle', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'id_rental', 'id');
    }
}