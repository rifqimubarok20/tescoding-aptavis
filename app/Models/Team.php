<?php

namespace App\Models;

use App\Models\Pertandingan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'city',
        'played',
        'wins',
        'losses',
        'draws',
        'goals_for',
        'goals_against',
        'points',
    ];

    public function pertandingan()
    {
        return $this->hasMany(Pertandingan::class, 'home_team_id')->orWhere('away_team_id', $this->id);
    }
}
