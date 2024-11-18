<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Javob extends Model
{
    protected $fillable = [
        'topshiriq_id',
        'region_id',
        'title',
        'file',
        'status'
    ];
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function topshiriq()
    {
        return $this->belongsTo(Topshiriq::class, 'topshiriq_id');
    }
}
