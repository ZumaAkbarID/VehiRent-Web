<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // Guard
    protected $guarded = ['id'];

    public function brand()
    {
        return $this->hasMany(Brand::class);
    }

    public function VehicleSpec()
    {
        return $this->hasMany(VehicleSpec::class, 'id_type', 'id');
    }
}