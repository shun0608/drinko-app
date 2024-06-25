<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
  use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  protected $dates = ['deleted_at'];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function favorites()
  {
    return $this->hasMany(Favorite::class);
  }
}
