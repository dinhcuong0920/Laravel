<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product;
class HomeController extends Controller
{
    public function Home()
    {
        $data['products_fe']=product::where('featured',1)->where('img','<>','no-img.jpg')->take(4)->get();
        $data['products_new']=product::orderby('created_at','desc')->take(8)->get();
        return view('frontend.index',$data);
    }
}
