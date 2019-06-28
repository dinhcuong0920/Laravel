<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
class CartController extends Controller
{
    public function Cart()
    {
        
        $data['total']=Cart::total(0,'','.');
        $data['cart']=Cart::content();
        return view('frontend.cart.cart',$data);
    }
    public function DelCart($id)
    {
        Cart::remove($id);
        return redirect('/cart');
    }
    public function UpdateCart($rowId,$qty)
    {
        Cart::update($rowId,$qty);
        
    }
}
