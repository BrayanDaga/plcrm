<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShopingCartDetail;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShopingCart extends Model
{
    use HasFactory;
    protected $table = "shoping_cart";
    protected $fillable = ['user_id','status'];
    protected $guarded = ['id'];

    /**
     * Get all of the cartDetails for the ShopingCart
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartDetails(): HasMany
    {
        return $this->hasMany(ShopingCartDetail::class, 'shoping_cart_id');
    }
    public function scopeCartUser($query){
        return $query->where('user_id',auth()->user()->id)->where('status','<>','NO ACTION')->orderBy('updated_at','DESC');
    }
    public function scopeCartWaiting($query){
        return $query->where('user_id',auth()->user()->id)->where('status','WAITING')->orderBy('updated_at','DESC');
    }
}
