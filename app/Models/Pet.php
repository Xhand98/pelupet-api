<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'customer_id',
        'name',
        'species',
        'breed',
        'age',
        'weight',
        'medical_notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function appointments()
    {
        return $this->hasMany(GroomingAppointment::class);
    }
}
