<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\{product,category,attribute};
use Cart;
class ProductsController extends Controller
{
    public function Products(request $request)
    {
        if($request->category)
        {
            $data['products']=category::find($request->category)->product()->where('img','<>','no-img.jpg')->paginate(12);
        }
        elseif($request->start)
        {
            $data['products']=product::whereBetween('price',[$request->start,$request->end])->where('img','<>','no-img.jpg')->paginate(12);
        }
        else {
            $data['products']=product::where('img','<>','no-img.jpg')->paginate(12);
        }
        $data['category']=category::all();
        
        return view('frontend.product.shop',$data);
    }
    public function Detailproduct($slug)
    {
        $data['product']=product::where('slug',$slug)->first();
        $data['products']=product::where('img','<>','no-img.jpg')->where('featured',0)->orderby('created_at','desc')->take(4)->get();
        return view('frontend.product.detail',$data);
    }
    public function AddCart(request $request)
    {
        $product=product::find($request->id_product);
        Cart::add([
            'id' => $request->id_product,
            'name' => $product->name,
            'qty' => $request->quantity,
            'weight' => '0',
            'price' => Take_pricevariant($product,$request->attr),
            'options' => 
                        [
                        'img' => $product->img,
                        'attr'=>$request->attr
                        ]
            ]);
            return redirect('/cart');
    }
    
}
