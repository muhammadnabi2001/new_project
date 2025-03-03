<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class Javob extends Model
{
    use LogTrait;
    protected $fillable = [
        'topshiriq_id',
        'region_id',
        'title',
        'file',
        'status',
        'izoh'
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
