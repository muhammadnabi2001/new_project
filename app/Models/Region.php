<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'user_id',
        'name'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function topshiriqlar()
    {
        return $this->belongsToMany(Topshiriq::class, 'region_topshiriqs')->withPivot('status');
    }
    public function javoblar()
    {
        return $this->hasMany(Javob::class, 'region_id');
    }
}
