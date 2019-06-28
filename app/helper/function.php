<?php
function CheckErrors($errors,$name)
{
    if($errors->has($name))
    {
    echo "<div class='alert alert-danger' role='alert'>
    <strong>".$errors->first($name)."</strong>
    </div>";
    }

}
function CheckErrorscategory($errors,$name)
{
    if($errors->has('name'))
    {
    echo "<div class='alert bg-danger' role='alert'>
    <svg class='glyph stroked cancel'>
        <use xlink:href='#stroked-cancel'></use>
    </svg>Tên danh mục không được để trống!<a href='#' class='pull-right'><span class='glyphicon glyphicon-remove'></span></a>
</div>";
    }

}
function GetCategory($mang,$parent,$shift,$select)
{
	
foreach($mang as $value)
{
   if($value->parent==$parent)
   {
	  if($value->id==$select)
			{
			echo "<option selected value=".$value->id.">".$shift.$value->name."</option>";

			}
		else
			{
 			echo "<option value=".$value->id.">".$shift.$value->name."</option>";
			}
	   GetCategory($mang,$value->id,$shift.'---|',$select);
   }
}

}

function ShowCategory($mang,$parent,$shift)
{

foreach($mang as $value)
{
   if($value->parent==$parent)
   {
 	echo "<div class='item-menu'><span>".$shift.$value->name."</span>
     <div class='category-fix'>
         <a class='btn-category btn-primary' href='/admin/category/edit/".$value->id."'><i class='fa fa-edit'></i></a>
         <a onclick='return DelCategory(\"$value->name\")'class='btn-category btn-danger' href='/admin/category/del/".$value->id."'><i class='fas fa-times'></i></i></a>

     </div>
 </div>";
 ShowCategory($mang,$value->id,$shift.'---|');
   }
}

}

function attr_values($mang)
{
    $result=array();
    foreach($mang as $value)
    {
        $attr=$value->attribute->name;
        $result[$attr][]=$value->value;

    }
    return $result;
}
function Alert($thongbao)
{
    if(session($thongbao))
    {
        echo "<div class='alert alert-success' role='alert'>
            <strong>".session($thongbao)."</strong>
        </div>";
    }
}
//
function get_combinations($arrays)
{
    $result =array(array());
    foreach($arrays as $property =>$property_values)
    {
        $tmp =array();
        foreach($result as $result_item)
        {
            foreach($property_values as $property_value)
            {
                $tmp[] =array_merge($result_item,array($property =>$property_value));
            }
        }
        $result = $tmp;
    }
    return $result;
}
function check_value($product,$value_check)
{
    foreach($product->values as $value)
    {
        if($value->id==$value_check)
        {
            return true;
        }
    }
    return false;
}
function check_variant($product,$array)
{
    foreach($product->variant as $row)
    {
        $mang=array();
        foreach ($row->values as $value) {
            $mang[]=$value->id;
        }
        if(array_diff($mang,$array)==NULL)
        {
            return false;
        }
    }
    return true;
}
//lay gia theo bien the
function Take_pricevariant($product,$mang)
{
    foreach ($product ->variant as $row) {
        $array= array();
        foreach($row ->values as $value)
        {
            $array[]=$value->value;
        }
        if(array_diff($mang,$array)==NULL)
        {
            if($row->price==0)
            {
                return $product->price;
            }
            return $row->price;
        }
    }
    return $product->price;
}

function ShowListusers($users)
{
    foreach($users as $row){
    echo "<tr>
    <td>".$row->id."</td>
    <td>".$row->email."</td>
    <td>".$row->full."</td>
    <td>".$row->address."</td>
    <td>".$row->phone."</td>
    <td>".$row->level."</td>
    <td>
        <a href='/admin/user/edit/".$row->id."'class='btn btn-warning'><i class='fa fa-pencil' aria-hidden='true'></i> Sửa</a>
        <a onclick='return Deluser(\"$row->full\")'href='/admin/user/del/".$row->id."'class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i> Xóa</a>
    </td>
</tr>";
}
}