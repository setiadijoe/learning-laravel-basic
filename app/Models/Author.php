<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    public $fillable = ['name'];

    protected $casts = ['id' => 'string'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
