<?php

// app/Models/VehicleImage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Accessor for full image URL
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    // app/Models/Vehicle.php

public function images()
{
    return $this->hasMany(VehicleImage::class);
}
}