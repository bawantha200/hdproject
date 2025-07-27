<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    // app/Models/Vehicle.php
protected $fillable = [
    'brand', 'model', 'type', 'registration_number', 'daily_rate', 
    'status', 'description', 'added_by'
    

];

// Relationship to user (admin who added the vehicle)
public function addedBy() {
    return $this->belongsTo(User::class, 'added_by');
}


}
