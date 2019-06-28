<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\{variant,product};
class VariantController extends Controller
{
    
    public function EditVariant($id)
    {
        $data['product']=product::find($id);
        return view('backend.product.variant.editvariant',$data);
    }
    public function AddVariant($id)
    {
        $data['product']=product::find($id);
        return view('backend.product.variant.addvariant',$data);
    }
    public function PostAddVariant(request $request,$id)
    {
        foreach ($request->variant as $key => $value) {
            $vari =variant::find($key);
            $vari->price=$value;
            $vari->save();
        }
        return redirect('admin/product')->with('thongbao','Đã thêm thành công!');
    }
    
    public function DelVariant($id)
    {
        variant::destroy($id);
        return redirect()->back()->with('thongbao','Bạn đã xóa biến thể thành công!');
    }
    public function PostEditVariant(request $request,$id)
    {
        foreach($request->variant as $key => $value)
        {
            $variant=variant::find($key);
            $variant->price=$value;
            $variant->save();
        }
        return redirect('/admin/product');
    }
    
}
