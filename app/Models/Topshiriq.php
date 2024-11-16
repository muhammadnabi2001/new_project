<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topshiriq extends Model
{
    protected $fillable=[
        'category_id',
        'ijrochi',
        'title',
        'description',
        'file',
        'muddat'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function regions()
    {
        return $this->belongsToMany(Region::class,'region_topshiriqs','region_id','topshiriq_id');
    }
}
