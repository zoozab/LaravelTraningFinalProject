<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMultiImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function SiteProducts()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
