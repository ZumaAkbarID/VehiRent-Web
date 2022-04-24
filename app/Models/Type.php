<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // Guard
    protected $guarded = ['id'];

    // Query Scope
    public function scopeFilter($query, array $filter)
    {
        $query->when(
            $filter['search'] ?? false,
            fn ($query, $search) =>
            $query->where(
                fn ($query) =>
                $query->where('type_name', 'like', '%' . $search . '%')
            )
        );
    }

    public function brand()
    {
        return $this->hasMany(Brand::class);
    }

    public function VehicleSpec()
    {
        return $this->hasMany(VehicleSpec::class, 'id_type', 'id');
    }
}