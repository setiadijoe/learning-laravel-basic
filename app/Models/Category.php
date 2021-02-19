<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public $fillable = ['name'];

    public $incrementing = false;

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function checkCategory($categoryId)
    {
        return $this->where('id', $categoryId)->first();
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
