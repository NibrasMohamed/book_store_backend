<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'name',
        'description',
        'published_date',
        'author_id',
        'image_path',
    ];

    public function author(){
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
}
