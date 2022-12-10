<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function productsForSales()
    {
        return $this->belongsTo(ProductsForSale::class, 'product_id', 'id');
    }
}
