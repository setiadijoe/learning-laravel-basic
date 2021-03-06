<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    public $fillable = ['name'];

    public $incrementing = false;

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function checkAuthor($authorId)
    {
        return $this->where('id', $authorId)->first();
    }

    public function isExist($name)
    {
        return $this->where('name', $name)->first();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
