<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionTopshiriq extends Model
{
    protected $table='region_topshiriqs';
    protected $fillable=[
        'region_id',
        'topshiriq_id',
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
