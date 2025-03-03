<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    use LogTrait;
    protected $fillable=[
        'user_id',
        'code'
    ];
}
