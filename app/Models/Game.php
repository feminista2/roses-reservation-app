<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = ['opponent', 'game_date', 'kickoff_time', 'location', 'reservation_type'];

    // Define the relationship to reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

