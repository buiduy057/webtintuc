<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // function __construct()
    // {
    // 	$this->DangNhap();

    // }
    // function DangNhap(){
    //     // kiểm tra đăng nhập
    //     if(Auth::check()){
    //     	view()->share('users_login',Auth::user());
    //     }
    // }
}
