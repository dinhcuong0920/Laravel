<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\{attribute,values};
use App\Http\Requests\{PostEditValueRequest,PostEditAttrRequest,AddAttrRequest,AddValueRequest};
class AttrController extends Controller
{
    public function Attr()
    {   
        
        $data['attrs']=attribute::all();
        return view('backend.product.attr.attr',$data);
    }
    public function EditAttr($id)
    {   
        $data['attr']=attribute::find($id);
        return view('backend.product.attr.editattr',$data);
    }
    public function EditValue($id)
    {
        $data['value']=values::find($id);
        return view('backend.product.attr.editvalue',$data);
    }
    public function AddAttr(AddAttrRequest $request)
    {
        $attr=new attribute;
        $attr->name=$request->name_attr;
        $attr->save();
        return redirect()->back()->with('thongbao','Bạn đã thêm thuộc tính thành công!');
    }
    public function AddValue(AddValueRequest $request)
    {
        
        $value=new values;
        $value->value=$request->name_value;
        $value->attr_id=$request->attr_id;
        $value->save();
        return redirect()->back()->with('thongbao','Bạn đã thêm giá trị thuộc tính thành công!');
    }
    public function PostEditAttr(PostEditAttrRequest $request,$id)
    {
        
        $attr=attribute::find($id);
        $attr->name=$request->name_attr;
        $attr->save();
        return redirect()->back()->with('thongbao','Đã sửa thuộc tính thành công!');

    }
    public function PostDelAttr($id)
    {
        
        attribute::destroy($id);
        return redirect()->back()->with('thongbao','Đã đã xóa thuộc tính thành công!');

    }
    
    public function PostEditValue(PostEditValueRequest $request,$id)
    {
        
        $value=values::find($id);
        $value->value=$request->value;
        return redirect()->back()->with('thongbao','Đã sửa giá trị thuộc tính thành công!');

    }
}
