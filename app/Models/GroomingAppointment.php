<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroomingAppointment extends Model
{
    protected $fillable = [
        'customer_id',
        'pet_id',
        'service_id',
        'appointment_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
