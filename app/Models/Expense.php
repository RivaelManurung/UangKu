<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['user_id', 'category_id', 'balance_id', 'amount', 'currency', 'date', 'description', 'payment_method', 'reference', 'is_recurring', 'recurring_interval', 'recurring_end_date'];

    protected $casts = ['date' => 'date', 'is_recurring' => 'boolean', 'recurring_end_date' => 'date'];

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