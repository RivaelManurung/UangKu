<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'profile_photo'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function balances()
    {
        return $this->hasMany(Balance::class);
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo ? asset('storage/' . $this->profile_photo) : asset('images/default-avatar.png');
    }
}