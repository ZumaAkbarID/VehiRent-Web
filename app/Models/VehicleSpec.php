<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleSpec extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function type()
    {
        return $this->belongsTo(Type::class, 'id_type', 'id');
    }

    public function rental()
    {
        return $this->hasMany(Rental::class, 'id', 'id_vehicle');
    }
}