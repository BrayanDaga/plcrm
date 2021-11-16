<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartDetail;
use App\Traits\ResponseFormat;

class CartController extends Controller
{
    use ResponseFormat;

    public function validateCart(Course $course){
        $cart = ShoppingCart::CartUser()->first();
        if(!isset($cart) or $cart->status == "BOUGHT"){
            $this->createCart(auth()->user()->id);
            $cart = (ShoppingCart::CartWaiting()->first())->id;
            $this->addCart($course,$cart);
        }else if($cart->status == "WAITING"){
            if(ShoppingCartDetail::where('shopping_cart_id',$cart->id)->
                                where('courses_id',$course->id)
                                ->count() == 0){
                $this->addCart($course,$cart->id);
            }
        }
        return $this->showCart();
    }
    public function createCart($user){
        $cart = new ShoppingCart();
        $cart->user_id = $user;
        $cart->save();
    }
    public function addCart($course,$cart){
        $cartDetail = new ShoppingCartDetail();
        $cartDetail->shopping_cart_id = $cart;
        $cartDetail->courses_id = $course->id;
        $cartDetail->save();
    }
    public function removeCart($cartDetail){
        ShoppingCartDetail::where('id',$cartDetail)->delete();
        return $this->showCart();
    }
    public function clearCart($cart){
        ShoppingCartDetail::where('shopping_cart_id',$cart)->delete();
        return $this->showCart();
    }
    public function updateCart($action){
        $cart = ShoppingCart::CartWaiting()->first();
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
        $cart = ShoppingCart::CartWaiting()->first();
        if($cart!=null){
            $cart = $cart->id;
            $details = ShoppingCartDetail::where('shopping_cart_id',$cart)->get();
            if(count($details)>0){
                return $this->responseOk('',$details);
            }else{
                return ["error"=>"Empty shopping cart"];
            }
        }else{
            return ["error"=>"Not exists shopping cart"];
        }
    }
}
