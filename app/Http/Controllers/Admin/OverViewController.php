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

        //Statical For A/B Testing

        //Total of A Before
        $fname = './img/TestingType/A/befor_send.txt';
        $fp = fopen($fname,'r');
        $ABefore = fread($fp, filesize($fname));
        //Total of B Before
        $fname = './img/TestingType/B/befor_send.txt';
        $fp = fopen($fname,'r');
        $BBefore = fread($fp, filesize($fname));
        //Total of A After
        $fname = './img/TestingType/A/after_send.txt';
        $fp = fopen($fname,'r');
        $AAfter = fread($fp, filesize($fname));
        //Total of B After
        $fname = './img/TestingType/B/after_send.txt';
        $fp = fopen($fname,'r');
        $BAfter = fread($fp, filesize($fname));
        //Total of A compleate
        $AComplate = User::select('id')->where('TestingType','A')->count();
        //Total of B compleate
        $BComplate = User::select('id')->where('TestingType','B')->count();

        //PRESINT For B [wash and go]
        $PrB = ($BAfter / $BBefore) * 100;

        //PRESINT FOR A COMPLATE
        $PrAComplate = ($AComplate / $AAfter) * 100;


        //PRESINT FOR B COMPLATE
        $PrBComplate = ($BComplate / $BAfter) * 100;

        //End Statical For A/B Testing


        return view('admin.overView.index',compact('BusinessTypeTotal','CountOfUsers','CountOfImgs','Nots','ABefore','AAfter','BBefore','BAfter','AComplate','BComplate','PrAComplate','PrBComplate','PrB'));
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
