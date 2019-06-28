<?php

namespace App\Http\Controllers\backend;
use App\Http\Requests\{PostEditProductRequest,AddProductRequest};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product;
use App\models\{attribute,category,variant};

class ProductController extends Controller
{
    public function Product()
    {   
        $data['products']=product::paginate(3);
        return view('backend.product.listproduct',$data);
    }
    
    public function DelProduct($id)
    {   
       product::destroy($id);
       return redirect()->back()->with('thongbao','Bạn đã xóa sản phẩm thành công!');
    }
    public function EditProduct($id)
    {   
        $data['product']=product::find($id);
        $data['category']=category::all();
        $data['attrs']=attribute::all();
        return view('backend.product.editproduct',$data);
    }
    public function Addproduct()
    {
        $data['attrs']=attribute::all();
        $data['category']=category::all();
        return view('backend.product.addproduct',$data);
    }
    public function PostAddproduct(AddProductRequest $request)
    {
        
        $product=new product ;
        $product->category_id=$request->category;
        $product->code=$request->product_code;
        $product->name=$request->product_name;
        $product->slug=str_slug($request->product_name);
        $product->price=$request->product_price;
        $product->featured=$request->product_featured;
        $product->state=$request->product_state;
        $product->info=$request->info;
        $product->describe=$request->description;
        if($request->hasFile('product_img'))
        {
            $file=$request->product_img;
            $filename=str_slug($file).'.'.$file->getClientOriginalExtension();
            $file->move('admins/img',$filename);
            $product->img=$filename;
        }
        else 
        {
            $product->img='no-img.jpg';
        }
        $product->save();
        //add value

        $mang=array();
        foreach($request->attr as $value)
        {
            foreach ($value as $item) {
                $mang[]=$item;
            }
        }
        $product->values()->Attach($mang);
        //add variant

        $variant = get_combinations($request->attr);
        foreach($variant as $var)
        {
            $vari = new variant;
            $vari->product_id=$product->id;
            $vari->save();
            $vari->values()->Attach($var);
        }
        return redirect('admin/product/add-variant/'.$product->id);

    }
    public function PostEditProduct(PostEditProductRequest $request,$id)
    {
        
        $product=product::find($id);
        $product->category_id=$request->category;
        $product->code=$request->product_code;
        $product->name=$request->product_name;
        $product->slug=str_slug($request->product_name);
        $product->price=$request->product_price;
        $product->featured=$request->product_featured;
        $product->state=$request->product_state;
        $product->info=$request->info;
        $product->describe=$request->description;
        if($request->hasFile('product_img'))
        { 
            if($product->img != 'no-img.jpg')
            {
            unlink('admins/img/'.$product->img);
            }
            $file=$request->product_img;
            $filename=str_slug($file).'.'.$file->getClientOriginalExtension();
            $file->move('admins/img',$filename);
            $product->img=$filename;
        }
        
        $product->save();
        //edit values
        $mang=array();
        foreach($request->attr as $value)
        {
            foreach ($value as $item) {
                $mang[]=$item;
            }
        }
        $product->values()->Sync($mang);
        //edit vriant
        $variant = get_combinations($request->attr);
        foreach($variant as $var)
        {   
            if(check_variant($product,$var))
            {
            $vari = new variant;
            $vari->product_id=$product->id;
            $vari->save();
            $vari->values()->Attach($var);
            }
        }
        return redirect()->back()->with('thongbao','Bạn sửa sản phẩm thành công!');

    }
    
}
