<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['category_id', 'judul', 'penulis', 'penerbit', 'stok', 'cover',];

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }

}
