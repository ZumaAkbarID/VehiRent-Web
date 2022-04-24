<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleSpec extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Query Scope
    public function scopeFilter($query, array $filter)
    {
        $query->when(
            $filter['search'] ?? false,
            fn ($query, $search) =>
            $query->where(
                fn ($query) =>
                $query->where('vehicle_name', 'like', '%' . $search . '%')
                    ->orWhere('number_plate', 'like', '%' . $search . '%')
            )
        );
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'id_type', 'id');
    }

    public function rental()
    {
        return $this->hasMany(Rental::class, 'id', 'id_vehicle');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand', 'id');
    }
}