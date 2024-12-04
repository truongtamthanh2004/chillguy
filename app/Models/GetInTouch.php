<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetInTouch extends Model
{
    protected $table = 'get_in_touch_truongtamthanh';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'message'
    ];
}
