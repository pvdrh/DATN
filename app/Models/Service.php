<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'services';
    protected $fillable = [
        'name',
        'agency_id',
        'price',
        'description',
        'duration',
        'type',
        'status'
    ];

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_service');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
