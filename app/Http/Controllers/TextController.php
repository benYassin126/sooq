<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Img;
use App\UserDesign;
use App\TemplateImg;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use Image;
use DB;
use I18N_Arabic;
include 'word2uni.php';

class TextController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('fetch_image');
    }

    public function index()
    {
        $UserID = Auth::id();
        $allImg = UserDesign::all()->where('UserID',$UserID);
        return view('user.text.index',compact('allImg'));
    }


    public function add(Request $request) {

      $image_id = $request->id;
      $color = hexdec($request->color);
      $text = $request->text;
      $UserID = Auth::id();
      $folderName = './img/before/'. $UserID;
     //   $price = $request->price;

      if (!file_exists($folderName)) {
            mkdir($folderName, 0777, true);
        }

        //check if input is arabic convert to uni to acept arabic lang
       require('./I18N/Arabic.php');
       $Arabic = new I18N_Arabic('Glyphs');
       $text = $Arabic->utf8Glyphs($text);



        //get the image and store it into before file
        $allImg = UserDesign::select('TheImg','DesignID')->where('id',$image_id)->first();
        $img = imagecreatefromstring($allImg->TheImg);
        imagepng($img, "./img/before/". $UserID . '/' . $image_id .".png", 9);

        $DesignID = $allImg->DesignID;

        $font =  realpath('./font/ae_AlHor.ttf');


        //get x and y place
       $Template = TemplateImg::select('TextX','TextY','PriceX','PriceY')->where('id',$DesignID)->first();

      // dd($Template->TextY);

       //if template not aceprt text
       if ($Template->TextX == 0 || $Template->TextY == 0) {
             return redirect()->back()->with('erorr', 'صورة غير قابلة للكتابة');
       }

       //Right to lift
       $dimensions = imagettfbbox(100, 0, $font, $text);
       $textWidth = abs($dimensions[4] - $dimensions[0]);
       $x = imagesx($img) - $textWidth;
       $xRight = $x - 700;
     //  dd($xx);


        //start write a text into image
         imagettftext($img, 100, 0, $xRight, $Template->TextY, $color, $font, $text);
        // imagettftext($img, 100, 0,$Template->PriceX, $Template->PriceY, $color, $font, $price);
        $image = Image::make($img);
        Response::make($image->encode('png'));

        //start update image
           $form_data = array(
              'TheImg' => $image,
          );

       $image = UserDesign::find($image_id);
       $image->update($form_data);
       return redirect()->back()->with('success', 'تم اضافة النص');

    }

    public function edit(Request $request) {
        $image_id = $request->id;
        $color = hexdec($request->color);
        $text = $request->text;
        $UserID = Auth::id();
      //  $price = $request->price;
        $folderName = './img/before/'. $UserID;
     //   $price = $request->price;

      if (!file_exists($folderName)) {
            mkdir($folderName, 0777, true);
        }

       $font =  realpath('./font/ae_AlHor.ttf');


       require('./I18N/Arabic.php');
       $Arabic = new I18N_Arabic('Glyphs');
       $text = $Arabic->utf8Glyphs($text);

       $image_file = './img/before/'. $UserID . '/' . $image_id . '.png';
       $image = imagecreatefrompng($image_file);


       $allImg = UserDesign::select('TheImg','DesignID')->where('id',$image_id)->first();
       $DesignID = $allImg->DesignID;



        //get x and y place
       $Template = TemplateImg::select('TextX','TextY','PriceX','PriceY')->where('id',$DesignID)->first();


       //Right to lift to difne value of x-cor
       $dimensions = imagettfbbox(100, 0, $font, $text);
       $textWidth = abs($dimensions[4] - $dimensions[0]);
       $x = imagesx($image) - $textWidth;
       $xRight = $x - 700;

       imagettftext($image, 100, 0, $Template->TextX, $Template->TextY, $color, $font, $text);
     //  imagettftext($image, 100, 0,$Template->PriceX, $Template->PriceY, $color, $font, $price);

       $image = Image::make($image);
       Response::make($image->encode('png'));

       //start update image
       $form_data = array(
          'TheImg' => $image,
       );

       $image = UserDesign::find($image_id);
       $image->update($form_data);
       return redirect()->back()->with('success', 'تم تعديل النص بنجاح');

    }

    public function delete(Request $request) {

       $image_id = $request->id;
        $UserID = Auth::id();
       $image_file = './img/before/'. $UserID . '/' . $image_id . '.png';
       $image = imagecreatefrompng($image_file);
        $image = Image::make($image);
       Response::make($image->encode('png'));
       //start update image
       $form_data = array(
          'TheImg' => $image,
       );
       $image = UserDesign::find($image_id);
       $image->update($form_data);
       unlink($image_file);
       return redirect()->back()->with('success', 'تم حذف النص بنجاح');
    }

   function fetch_image($image_id)
   {
       $image = UserDesign::findOrFail($image_id);

       $image_file = Image::make($image->TheImg);

       $response = Response::make($image_file->encode('png'));

       $response->header('Content-Type', 'image/png');

       return $response;
   }
}
