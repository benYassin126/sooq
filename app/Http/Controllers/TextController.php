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
require('./I18N/Arabic.php');


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




    public function addPrices () {
        $UserID = Auth::id();
        $allImg = Img::all()->where('UserID',$UserID)->first();
        $allUserDesign = UserDesign::all()->where('UserID',$UserID);

        //Start Check if user has designs
        if (count($allUserDesign) <= 0) {
             return redirect()->back()->with('erorr', 'اضف تصميم اولا');
        }

        //END Check if user has designs

        //Start check if Procdects not empty
        if ($allImg->ImgName == null && $allImg->ImgPrice == null && $allImg->ImgLPrice == null && $allImg->ImgMPrice == null) {
              return redirect('/imgs')->with('erorr', 'يجب عليك اضافة بينات المنتجات واسعارها كي تتمكن من اضافتها للتصميم');
        }
        //End check if Procdects not empty


        //Start Write Prices To Template

        //To Adjest Arbic Text
        $Arabic = new I18N_Arabic('Glyphs');

        //Genral Options
        $font =  realpath('./font/ae_AlHor.ttf');
        $color = hexdec('#000000');
        $White = hexdec('#ffffff');
        $xC = 100;
        $yC = 440;
        $yT = $yC - 20;
        $yP = $yC + 10;



        //get all Template Imgs
        foreach ($allUserDesign as $singleDesign) {
            $img = imagecreatefromstring($singleDesign->TheImg);

            //get Prodect Data
            $TheProdect = Img::select('ImgPrice','ImgLPrice','ImgMPrice','ImgSPrice','ImgSection','ImgName','ShowName')->where('id',$singleDesign->ImgID)->first();
            $ShowName = $TheProdect->ShowName;
            $ProcdectOrginalPrice = $TheProdect->ImgPrice;
            $ProcdectLargePrice = $TheProdect->ImgLPrice;
            $ProcdectSmallPrice = $TheProdect->ImgSPrice;
            $ProcdectMediumPrice = $TheProdect->ImgMPrice;


            //First Case [Fill All Pricess or Fill All Pricess Exept Orginal] => Take just Multip

            if ($ProcdectOrginalPrice != null && $ProcdectLargePrice != null || $ProcdectOrginalPrice == null && $ProcdectLargePrice != null) {

                //Small
                imagefilledellipse($img, $xC, $yC, 90, 90, $White);
                imagettftext($img, 18, 0, $xC - 20, 440 - 20, $color, $font, $Arabic->utf8Glyphs('صغير'));
                imagettftext($img, 14, 0, $xC - 23, 440 + 10, $color, $font, $ProcdectSmallPrice . ' SR');

                //Mediume
                imagefilledellipse($img, $xC, $yC + 100, 90, 90, $White);
                imagettftext($img, 18, 0, $xC - 20, 540 - 20, $color, $font, $Arabic->utf8Glyphs('وسط'));
                imagettftext($img, 14, 0, $xC  - 23, 540 + 10, $color, $font, $ProcdectMediumPrice . ' SR');

                //Large
                imagefilledellipse($img, $xC , $yC + 200, 90, 90, $White);
                imagettftext($img, 18, 0, $xC  - 10, 640 - 20, $color, $font, $Arabic->utf8Glyphs('كبير'));
                imagettftext($img, 14, 0, $xC  - 23, 640 + 10 , $color, $font, $ProcdectLargePrice . ' SR');

            }elseif ($ProcdectOrginalPrice != null && $ProcdectLargePrice == null) {
                //Second Case [Fill Just Orginal] = >fill just orginal
                imagefilledellipse($img, 750, 260, 90, 90, $White);
                if ($ProcdectOrginalPrice - floor($ProcdectOrginalPrice)>0) {
                    imagettftext($img, 18, 0,720, 270, $color, $font, $ProcdectOrginalPrice);

                }else{
                imagettftext($img, 18, 0, 720, 270, $color, $font, $ProcdectOrginalPrice .' SR');

            }

            //Prodect Nmae if singale price
            if ($ProcdectOrginalPrice != null && $ProcdectLargePrice == null && $ShowName == 'yes') {
              $ProcdectName = $Arabic->utf8Glyphs($TheProdect->ImgName);
              imagefilledrectangle($img, 720, 250, 600, 280, $White);
              imagettftext($img, 14, 0, 620, 270, $color, $font, $ProcdectName);
            }


            }



            //start update image
            $img = Image::make($img);
            Response::make($img->encode('png'));
            $form_data = array(
            'TheImg' => $img,
            );

            $image = UserDesign::find($singleDesign->id);
            $image->update($form_data);
        }


       return redirect()->back()->with('success', 'تم اضافة الاسعار بنجاح .. لحذف الاسعار اضغط على تصميم جديد');





        //End Write Prices To Template

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

/*
       //if template not aceprt text
       if ($Template->TextX == 0 || $Template->TextY == 0) {
             return redirect()->back()->with('erorr', 'صورة غير قابلة للكتابة');
       }
*/
       //Right to lift
       $dimensions = imagettfbbox(100, 0, $font, $text);
       $textWidth = abs($dimensions[4] - $dimensions[0]);
       $x = imagesx($img) - $textWidth;
       $xRight = $x - 700;


        //start write a text into image
        // imagettftext($img, 100, 0, $xRight, 200, $color, $font, $text);
          // imagettftext($img, 100, 0,$Template->PriceX, $Template->PriceY, $color, $font, $price);


$White = hexdec('#ffffff');

$xC = 100;
$yC = 440;
$yT = $yC - 20;
$yP = $yC + 10;
$text = $Arabic->utf8Glyphs('مظغوط');
/*
$xT =
$yT =
$xP =
$yP =
*/


/*
$text = '10 SR';
imagefilledellipse($img, $xC * 2, $yC, 90, 90, $White);
imagettftext($img, 18, 0, $xC * 2 - 20, $yT, $color, $font, $Arabic->utf8Glyphs('وسط'));
imagettftext($img, 14, 0, $xC * 2 - 20, $yP, $color, $font, $text);


$text = '15 SR';
imagefilledellipse($img, $xC * 3, $yC, 90, 90, $White);
imagettftext($img, 18, 0, $xC * 3 - 15, $yT, $color, $font, $Arabic->utf8Glyphs('كبير'));
imagettftext($img, 14, 0, $xC * 3 - 20, $yP, $color, $font, $text);
*/

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
