<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\user;
class UserController extends Controller
{
    function Getlistuser()
    {
        $data['users']=user::paginate(4);
        return view('backend.user.listuser',$data);
    }
}
