<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use session_start;

class CartController extends Controller
{
    public function createCart(){}
    public function addCart(Course $course){}
    public function showCart(){}
    public function removeCart(){}
    public function clearCart(){}
    public function updateCart($action){}
}
