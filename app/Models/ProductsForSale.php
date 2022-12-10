<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsForSale extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function catagories()
    {
        return $this->belongsTo(Catagory::class, 'catagory_id', 'id');
    }


    public function comments()
    {
        return $this->hasMany(comments::class, 'product_id');
    }
    public function site_multi_images()
    {
        return $this->hasMany(SiteMultiImage::class, 'product_id');
    }
}
