<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ShopingCart;
use App\Models\ShopingCartDetail;
use App\Traits\ResponseFormat;

class CartController extends Controller
{
    use ResponseFormat;

    public function validateCart(Course $course){
        $cart = ShopingCart::CartUser()->first();
        if(!isset($cart) or $cart->status == "BOUGHT"){
            $this->createCart(auth()->user()->id);
            $cart = (ShopingCart::CartWaiting()->first())->id;
            $this->addCart($course,$cart);
        }else if($cart->status == "WAITING"){
            $this->addCart($course,$cart->id);
        }
        return $this->showCart();
    }
    public function createCart($user){
        $cart = new ShopingCart();
        $cart->user_id = $user;
        $cart->save();
    }
    public function addCart($course,$cart){
        if(ShopingCartDetail::where('courses_id',$course->id)->count() == 0){
            $cartDetail = new ShopingCartDetail();
            $cartDetail->shoping_cart_id = $cart;
            $cartDetail->courses_id = $course->id;
            $cartDetail->save();
        }
    }
    public function removeCart($cartDetail){
        ShopingCartDetail::where('id',$cartDetail)->delete();
        return $this->showCart();
    }
    public function clearCart($cart){
        ShopingCartDetail::where('shoping_cart_id',$cart)->delete();
        return $this->showCart();
    }
    public function updateCart($action){
        $cart = ShopingCart::CartWaiting()->first();
        switch ($action) {
            case 0:
                $cart->status = "NO ACTION";
                $cart->save();
                break;
            case 1:
                $cart->status = "BOUGHT";
                $cart->save();
                break;
        }
    }
    public function showCart(){
        $cart = (ShopingCart::CartWaiting()->first())->id;
        $details = ShopingCartDetail::where('shoping_cart_id',$cart)->get();
        return $this->responseOk('',$details);
    }
}
