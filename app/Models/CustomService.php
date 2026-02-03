<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomService extends Model
{
    protected $fillable = [
        'customer_id',
        'service_name',
        'description',
        'estimated_price',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'estimated_price' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
