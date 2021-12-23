<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cup extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable =['year', 'place', 'country', 'winner', 'logo', 'user_id'];

    public function getIDAttribute()
    {
        return $this->attributes['id'];
    }
    public function getYearAttribute()
    {
        return $this->attributes['year'];
    }
    public function getPlaceAttribute()
    {
        return $this->attributes['place'];
    }
    public function getCountryAttribute()
    {
        return $this->attributes['country'];
    }
    public function getWinnerAttribute()
    {
        return $this->attributes['winner'];
    }
    public function getWinnerLogoAttribute()
    {
        return $this->attributes['logo'];
    }
    public function getUserIdAttribute()
    {
        return $this->attributes['user_id'];
    }
    public function getOwnerNameAttribute()
    {
        $user = User::where('id','=', $this->attributes['user_id'])->get();
        return $user[0]['name'];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
