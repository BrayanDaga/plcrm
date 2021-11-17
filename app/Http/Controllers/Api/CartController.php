<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassroomCart;
use App\Models\ClassroomCartDetail;
use App\Models\Course;
use App\Traits\ResponseFormat;

class CartController extends Controller
{
    use ResponseFormat;

    public function validateCart(Course $course){
        $cart = ClassroomCart::CartUser()->first();
        if(!isset($cart) or $cart->status == "BOUGHT"){
            $this->createCart(auth()->user()->id);
            $cart = (ClassroomCart::CartWaiting()->first())->id;
            $this->addCart($course,$cart);
        }else if($cart->status == "WAITING"){
            if(ClassroomCartDetail::where('classroom_cart_id',$cart->id)->
                                where('courses_id',$course->id)
                                ->count() == 0){
                $this->addCart($course,$cart->id);
            }
        }
        return $this->showCart();
    }
    public function createCart($user){
        $cart = new ClassroomCart();
        $cart->user_id = $user;
        $cart->save();
    }
    public function addCart($course,$cart){
        $cartDetail = new ClassroomCartDetail();
        $cartDetail->classroom_cart_id = $cart;
        $cartDetail->courses_id = $course->id;
        $cartDetail->save();
    }
    public function removeCart($cartDetail){
        ClassroomCartDetail::where('id',$cartDetail)->delete();
        return $this->showCart();
    }
    public function clearCart($cart){
        ClassroomCartDetail::where('classroom_cart_id',$cart)->delete();
        return $this->showCart();
    }
    public function updateCart($action){
        $cart = ClassroomCart::CartWaiting()->first();
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
        $cart = ClassroomCart::CartWaiting()->first();
        if($cart!=null){
            $cart = $cart->id;
            $details = ClassroomCartDetail::SltData()->where('classroom_cart_id',$cart)->with('courses')->get();
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
