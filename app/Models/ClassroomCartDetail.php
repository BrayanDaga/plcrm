<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomCartDetail extends Model
{
    use HasFactory;
    protected $table = 'classroom_cart_detail';
    protected $fillable = ['classroom_cart_id','courses_id'];
    protected $guarded = ['id'];
}
