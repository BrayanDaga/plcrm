<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopingCartDetail extends Model
{
    use HasFactory;
    protected $table = 'shoping_cart_details';
    protected $fillable = ['shoping_cart_id','courses_id'];
    protected $guarded = ['id'];
}
