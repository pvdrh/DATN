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
        'start_time',
        'end_time',
        'note',
        'user_id',
        'agency_id'
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
