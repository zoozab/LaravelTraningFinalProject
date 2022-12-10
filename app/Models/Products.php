<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $guarded = [];
    // each product belong to spaccefic catagory
    // prudeucts has many catagories


    public function catagories()
    {
        return $this->belongsTo(Catagory::class, 'catagory_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function multi_images()
    {
        return $this->hasMany(MultiImage::class);
    }
}
