<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\category;
use App\Http\Requests\PostCategoryRequest;
use App\Http\Requests\PostEditCategoryRequest;
class CategoryController extends Controller
{
    function Category()
    {   
        $data['category']=category::all();
        return view('backend.category.category',$data);
    }
    function EditCategory($id)
    {   
        $data['cate']=category::find($id);
        $data['category']=category::all();
        return view('backend.category.editcategory',$data);
    }
    function PostCategory(PostCategoryRequest $request)
    {
        $cate=new category;
        $cate->name=$request->name;
        $cate->parent=$request->parent;
        $cate->slug=$request->name;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã thêm thành công');
    }
    function PostEditCategory(PostEditCategoryRequest $request,$id)
    {
        $cate=category::find($id);
        $cate->name=$request->name;
        $cate->slug=str_slug($request->name);
        $cate->parent=$request->parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Bạn đã sửa danh mục thành công!');
    }
    function DelCategory($id)
    {   
        $cate=category::find($id);
        category::where('parent',$id)->update(['parent'=>$cate['parent']]);
        category::destroy($id);
        return redirect('admin/category')->with('thongbao','Bạn đã xóa danh mục thành công!');
    }
}
