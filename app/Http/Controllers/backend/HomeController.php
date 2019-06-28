<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\models\customer;

class HomeController extends Controller
{
    public function Home()
    {
        $month_now=Carbon::now()->format('m');
        $year_now=Carbon::now()->format('Y');
        $months=array();
        $revenue=array();
        for($i=1;$i<=$month_now;$i++)
        {
            $months[$i]='Tháng '.$i;
            $revenue[$i]=customer::where('state',1)->whereMonth('updated_at',$i)->whereYear('updated_at',$year_now)->sum('total');
        }
        $data['months']=$months;
        $data['revenue']=$revenue;
        $data['order']=customer::where('state',1)->count();
        return view('backend.index',$data);
    }
}
