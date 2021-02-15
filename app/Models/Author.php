<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

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

    public function checkAuthor($authorId)
    {
        return $this->where('id', $authorId)->first();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4();
        });
    }
}
