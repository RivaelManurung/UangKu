<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['user_id', 'category_id', 'balance_id', 'amount', 'currency', 'date', 'description', 'source_type', 'reference'];

    protected $casts = ['date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function balance()
    {
        return $this->belongsTo(Balance::class);
    }
}