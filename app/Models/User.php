<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function createToken(string $name, array $abilities = ['*'])
    // {
    //     // dd($name);
    //     $token = $this->tokens()->create([
    //         'id' => Str::uuid(),
    //         'name' => $name,
    //         'token' => hash('sha256', $plainTextToken = Str::random(40)),
    //         'abilities' => $abilities,
    //     ]);
    //     // dd($token);

    //     return new NewAccessToken($token, $token->id.'|'.$plainTextToken);
    // }
    // public function tokens()
    // {
    //     return $this->morphMany(Sanctum::$personalAccessTokenModel, 'tokenable', "tokenable_type", "tokenable_uuid");
    // }
};
