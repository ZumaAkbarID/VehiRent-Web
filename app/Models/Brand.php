<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // Guard
    protected $guarded = ['brand_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}