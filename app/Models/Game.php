<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable =['date', 'stadium', 'level', 'first_team', 'second_team', 'num_of_pucks_first', 'num_of_pucks_second', 'winner'];

    public function getDateAttribute()
    {
        return $this->attributes['date'];
    }
    public function getStadiumAttribute()
    {
        return $this->attributes['stadium'];
    }
    public function getLevelAttribute()
    {
        return $this->attributes['level'];
    }
    public function getFirstTeamAttribute()
    {
        return $this->attributes['first_team'];
    }
    public function getSecondTeamAttribute()
    {
        return $this->attributes['second_team'];
    }
    public function getPucksFirstTeamAttribute()
    {
        return $this->attributes['num_of_pucks_first'];
    }
    public function getPucksSecondTeamAttribute()
    {
        return $this->attributes['num_of_pucks_second'];
    }
    public function getWinnerAttribute()
    {
        return $this->attributes['winner'];
    }
}
