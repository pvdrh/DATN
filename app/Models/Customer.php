<?php

namespace App\Models;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';
    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'gender',
        'medical_information',
        'dob',
        'agency_id'
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'customer_services');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
