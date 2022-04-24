<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // Guard
    protected $guarded = ['brand_id'];

    // Query Scope
    public function scopeFilter($query, array $filter)
    {
        $query->when(
            $filter['search'] ?? false,
            fn ($query, $search) =>
            $query->where(
                fn ($query) =>
                $query->where('brand_name', 'like', '%' . $search . '%')
            )
        );
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function vehicleSpec()
    {
        return $this->hasMany(VehicleSpec::class, 'id_brand', 'id');
    }
}