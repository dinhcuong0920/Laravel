<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\customer;
class OrderController extends Controller
{
    public function Order()
    {   
        $data['customers']=customer::where('state',0)->orderby('created_at','desc')->paginate(3);
        return view('backend.order.order',$data);
    }
    public function OrderProcessed()
    {
        $data['customers']=customer::where('state',1)->orderby('updated_at','desc')->paginate(3);
        return view('backend.order.orderprocessed',$data);
    }
    public function DetailOrder($id)
    {
        $data['customer']=customer::find($id);
        return view('backend.order.detailorder',$data);
    }
    
    public function CheckOrder($id)
    {
        $customer=customer::find($id);
        $customer->state=1;
        $customer->save();
        return redirect('/admin/order')->with('thongbao','Bạn đã xử lý đơn hàng thành công');
    }
}
