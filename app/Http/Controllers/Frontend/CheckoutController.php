<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use App\Http\Requests\PostCheckoutRequest;
use App\models\{customer,order,attr};
class CheckoutController extends Controller
{
    public function PostCheckout(PostCheckoutRequest $request)
    {
        if(Cart::count()==0)
        {
            return redirect()->back()->with('thongbao','Trong giỏ hàng của bạn không có sản phẩm nào');
        }
        $customer=new customer;
        $customer->full_name=$request->full;
        $customer->address=$request->address;
        $customer->email=$request->mail;
        $customer->phone=$request->telephone;
        $customer->total=Cart::total(0,'','');
        $customer->state=0;
        $customer->save();

        foreach (Cart::content() as $product) {
            $order=new order;
            $order->name=$product->name;
            $order->img=$product->options->img;
            $order->price=$product->price;
            $order->quantity=$product->qty;
            $order->customer_id=$customer->id;
            $order->save();

            foreach ($product->options->attr as $key => $value) {
                $attr=new attr;
                $attr->name=$key;
                $attr->order_id=$order->id;
                $attr->value=$value;
                $attr->save();
            }
        }
        Cart::destroy();
        return redirect('/checkout/complete/'.$customer->id);
    }
    public function Complete($id)
    {
        $data['customer']=customer::find($id);
        return view('frontend.checkout.complete',$data);
    }
    public function Checkout()
    {
        $data['cart']=Cart::content();
        $data['total']=Cart::total(0,'','.');
        return view('frontend.checkout.checkout',$data);
    }
}
