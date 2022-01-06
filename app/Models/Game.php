<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Game extends Model
{
    use HasFactory;
    protected $fillable =['date', 'stadium', 'level', 'winner'];

    public function getDateAttribute()
    {
        return Carbon::parse($this->attributes['date'])->format('d/m/Y');
    }
    public function getStadiumAttribute()
    {
        return $this->attributes['stadium'];
    }
    public function getLevelAttribute()
    {
        return $this->attributes['level'];
    }
    public function getWinnerAttribute()
    {
        return $this->attributes['winner'];
    }
    public function getOwnerNameAttribute()
    {
        $user = User::where('id','=', $this->attributes['user_id'])->get();
        return $user[0]['name'];
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cup()
    {
        return $this->belongsTo(Cup::class, 'castle_id');
    }
}
