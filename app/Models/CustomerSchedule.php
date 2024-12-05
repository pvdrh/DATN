<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSchedule extends Model
{
    use HasFactory;

    protected $table = 'customer_schedules';
    protected $fillable = [
        'customer_id',
        'start_date',
        'end_date',
        'note',
        'user_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
