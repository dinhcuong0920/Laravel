<?php

namespace App\Http\Controllers\backend;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\user;
use Illuminate\Support\Facades\Auth;
use Mail;
class LoginController extends Controller
{
    public function Login()
    {
        return view('backend.login');
    }
    public function Logout()
    {   
        Auth::logout();
        return redirect('login');   
    }
    public function PostLogin(LoginRequest $request)
    {   
        if($request->has('remember'))
        {
            $remember=true;
        }
        else {
            $remember=false;
        }
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember))
        {   
            
            return redirect('admin');
        }
        else
        {
            return redirect('login')->withInput()->with('thongbao','Tên tài khoản hoặc mật khẩu không chính xác');
        }

    }  
    function  SentMail()
    {
        $data['name']="cuong";
        Mail::send('mail', $data, function ($message) {
            $message->from('nguyendinhcuongkt94@gmail.com', 'Cuong');     
            $message->to('phucnguyenthe0809@gmail.com', 'khach hang');
            $message->subject('send mail nef');
        });
    }
}
