<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'jumlah_pinjam',
        'borrow_date',
        'due_date',
        'status',
    ];
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
