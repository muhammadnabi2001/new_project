<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use LogTrait;
    protected $fillable=[
        'name'
    ];
    public function topshiriqlar()
    {
        return $this->hasMany(Topshiriq::class,'category_id');
    }
}
