<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'type',
        'registration_number',
        'daily_rate',
        'status',
        'description',
        'added_by'
    ];

    protected $casts = [
        'daily_rate' => 'decimal:2'
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }

    // Accessor for formatted daily rate
    public function getFormattedDailyRateAttribute()
    {
        return 'LKR ' . number_format($this->daily_rate, 2);
    }

    // Accessor for full vehicle name
    public function getFullNameAttribute()
    {
        return $this->brand . ' ' . $this->model;
    }
}