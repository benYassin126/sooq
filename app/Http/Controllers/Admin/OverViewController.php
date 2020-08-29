<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Img;
use App\Nots;
use App\UserDesign;

class OverViewController extends Controller
{


    public function index () {

        $BusinessTypeTotal = User::groupBy('BusinessType')->select('BusinessType', DB::raw('count(*) as total'))->orderBy('id', 'DESC')->get();
        $Nots = Nots::select('Nots','PhoneNumber')->get();
        $CountOfUsers = User::select('id')->count();
        $CountOfImgs = Img::select('id')->count();
        return view('admin.overView.index',compact('BusinessTypeTotal','CountOfUsers','CountOfImgs','Nots'));
    }
    public function allDesigns () {
        $log_directory = 'img/show';
        $all = glob($log_directory .'/*.*');
        return view('admin.overView.allDesigns',compact('all'));
    }
    public function allImages () {
        $log_directory = 'img/all_images';
        $all = glob($log_directory .'/*.*');
        return view('admin.overView.allImages',compact('all'));
    }

    public function deleteAll() {
        $log_directory = 'img/show';
        $all = glob($log_directory .'/*.*');
        foreach ($all as  $img) {
              if(is_file($img))
                unlink($img); // delete file

          }
          return redirect()->back();
    }
}
