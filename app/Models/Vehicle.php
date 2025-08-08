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

 


    // Define relationship to User (using added_by column)
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


    public function scopeSearch($query, $searchTerm)
{
    if ($searchTerm) {
        return $query->where(function($q) use ($searchTerm) {
            $q->where('brand', 'like', "%{$searchTerm}%")
              ->orWhere('model', 'like', "%{$searchTerm}%")
              ->orWhere('description', 'like', "%{$searchTerm}%");
        });
    }
    return $query;
}

public function scopeStatusFilter($query, $status)
    {
        if ($status && $status !== 'all') {
            return $query->where('status', $status);
        }
        return $query;
    }


    // Status constants
    const STATUS_AVAILABLE = 'available';
    const STATUS_RENTED = 'rented';
    const STATUS_MAINTENANCE = 'maintenance';

    // Status options
    public static function getStatusOptions()
    {
        return [
            self::STATUS_AVAILABLE => 'Available',
            self::STATUS_RENTED => 'Rented',
            self::STATUS_MAINTENANCE => 'Maintenance'
        ];
    }






}