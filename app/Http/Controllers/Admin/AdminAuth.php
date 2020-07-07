<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
//use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use DB;
use Mail;

class AdminAuth extends Controller {
    //

    public function login() {
        return view('admin.login');
    }

    public function dologin() {
        $rememberme = request('rememberme') == 1?true:false;
        if (auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
            return redirect('admin');
        } else {
            return  redirect('admin/login')->with('erorrMsg','خطأ في بيانات الدخول');
        }
    }

    public function logout() {
        auth()->guard('admin')->logout();
        return redirect('admin/login');
    }


}
