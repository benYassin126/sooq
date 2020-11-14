<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use App\Img;
use App\TemplateImg;
use App\Interactive;
use App\Template;
use App\Nots;
use App\User;
use App\UserDesign;
use Image;
use Auth;
use Redirect;
use DB;
use Session;
use Crypt;
use inRandomOrder;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;
use I18N_Arabic;
require('./I18N/Arabic.php');




class TryController extends Controller
{

    public function index() {
        return view('try.index');
    }

    public function createStep1(Request $request)
    {
        return view('try.step1');
    }

    public function PostcreateStep1(Request $request)
    {
        //check if not insert any image
        if ($request->Transparent == null && $request->WithBackGound == null) {
              return back()->with('erorr', 'لابد من ادخال صورة منتج واحد على الاقل');
        }
        if ($request->Logo == null) {
              return back()->with('erorr', 'يرجى ادخال صورة الشعار او اي صورة تحتوي على الوان الهوية');
        }

       $messages = [
            "WithBackGound.max" => "عدد الصور أكثر من 15 صور",
            "Logo.required" => "يرجى ادخال صورة الشعار او اي صورة تحتوي على الوان الهوية",
         ];
        $validatedData = $this->validate($request, [
          'Transparent.*' => 'image|max:5120',//5MB
          'WithBackGound.*' => 'image|max:5120',//5MB
          'Logo' => 'image',//5MB
          'WithBackGound' => 'max:15',

       ],$messages);

        Session::forget('TransInputImage');
        Session::forget('WithBackInputImage');
        Session::forget('CountOfTry');
        session()->put('TransInputImage.image', []);
        session()->put('WithBackInputImage.image', []);

        //chose two random template
        $allTemplates = Template::select('id')->get();
        /*
        if ($request->WithBackGound == null) {
            $allTemplates = Template::select('id')->where('TemplateType','Transparent')->get();

        }
        if ($request->Transparent == null) {
            $allTemplates = Template::select('id')->where('TemplateType','WithBackGound')->get();
        }
        */
        $allTemplatesID = array();
        foreach ($allTemplates as $Template) {
            array_push($allTemplatesID, $Template->id);
        }


        shuffle($allTemplatesID);
        session()->put('FirstTemplate',$allTemplatesID[0]);
        session()->put('SecondTemplate',$allTemplatesID[0]);
        session()->put('ThirdTemplate',$allTemplatesID[0]);
        session()->put('CurentTemplate',session()->get('FirstTemplate'));


        // A/B Testing
        $TestingArray = ['A','B'];
        $randomKay = array_rand($TestingArray,1);
        session()->put('Testing',$TestingArray[$randomKay]);


        //STORE LOGO
        if ($request->has('Logo')) {
            $logoName = 'Logo_'. rand(0,9999);
            session()->put('logoName',$logoName);
            $image_file = $request->Logo;
            $image = Image::make($image_file);
            Response::make($image->encode('png'));
            session()->put('logoAsImage',$image);
            $image = imagecreatefromstring($image);
            imagealphablending($image, false);
            imagesavealpha($image, true);
            imagepng($image,'./img/storage/logos/'. $logoName . '.png',9);
        }



        if ($request->has('Transparent')  ) {
         foreach ($request->Transparent as $kay => $TransparentImg) {
             $image_file = $TransparentImg;
             $image = Image::make($image_file);
             Response::make($image->encode('png'));
             $request->session()->push('TransInputImage.image', $image);
         }
       }

       if ($request->has('WithBackGound')) {
         foreach ($request->WithBackGound as $kay => $WithBackGoundImg) {
             $image_file = $WithBackGoundImg;
             $image = Image::make($image_file);
             Response::make($image->encode('png'));
             $request->session()->push('WithBackInputImage.image', $image);
         }
       }





    //new After file for A/B Testing

    $TestingType = session()->get('Testing');

      if ($TestingType == 'A') {
        $fname = './img/TestingType/A/befor_send.txt';
        //Read count
        $fp = fopen($fname,'r');
        $count = fread($fp, filesize($fname));
        //conut
        $count = $count + 1;
        //write
        $fp = fopen($fname,'w');
        fwrite($fp, $count);

      }elseif ($TestingType == 'B') {
        $fname = './img/TestingType/B/befor_send.txt';
        //Read count
        $fp = fopen($fname,'r');
        $count = fread($fp, filesize($fname));
        //conut
        $count = $count + 1;
        //write
        $fp = fopen($fname,'w');
        fwrite($fp, $count);
      }

      //end Testing A/B


     return redirect('/try/form2');
 }

 public function createStep2(Request $request)
 {

    if (session::get('WithBackInputImage.image') == null) {
       $allTemplates = Template::select('id','TemplateBackGroundName')->where('TemplateType','Transparent')->get();
    }
    if(session::get('TransInputImage.image') == null) {

       $allTemplates = Template::select('id','TemplateBackGroundName')->where('TemplateType','WithBackGound')->get();
    }
    if(session::get('WithBackInputImage.image') != null && session::get('TransInputImage.image') != null ) {
      $allTemplates = Template::select('id','TemplateBackGroundName')->get();
    }

    $FirstTemplateID = $allTemplates->first()->id;


    //START GET COLORS FROM LOGO
    $LogoColors = array();
    session()->put('LogoColors.color', []);

    if (session()->get('logoName') != null) {
    $logoName = session()->get('logoName');
    $palette = Palette::fromFilename('./img/storage/logos/'. $logoName .'.png');
    $topFive = $palette->getMostUsedColors(5);

    foreach ($topFive as $color => $index) {
       $oneColor =  Color::fromIntToHex($color);
       array_push($LogoColors,$oneColor);
       $request->session()->push('LogoColors.color', $oneColor);
    }
    }

    //END GET COLORS FROM LOGO

    return view('try.step2',compact('allTemplates','FirstTemplateID','LogoColors'));
 }

public function PostcreateStep2(Request $request)
{


    if ($request->has('BusinessType')) {
       session()->put('BusinessType',$request->BusinessType);
    }
/*
    if ($request->has('OtherBusinessType') && $request->OtherBusinessType !=null ) {
       session()->put('BusinessType',$request->OtherBusinessType);
    }
*/

    if ($request->has('PhoneNumber')) {
       session()->put('PhoneNumber',$request->PhoneNumber );
    }

    if ($request->has('Instagram')) {
       session()->put('Instagram',$request->Instagram );
    }

    if ($request->has('Twitter')) {
       session()->put('Twitter',$request->Twitter );
    }

    if ($request->has('MineColor')) {
        session()->put('MineColor',$request->MineColor );
        }

    if ($request->has('SubColor')) {
        session()->put('SubColor',$request->SubColor );
        }


    $FirstTemplate = session()->get('FirstTemplate');
    $SecondTemplate = session()->get('SecondTemplate');
    $ThirdTemplate = session()->get('ThirdTemplate');
    $CurentTemplate = session()->get('CurentTemplate');
        //start if user come from control panel

      if ($request->has('oldUser')) {

        $UserID = $request->UserID;
        $user = User::select('MineColor','SubColor','CurentTemplate','Instagram')->where('id',$UserID)->first();
        //chose two random template
        $allTemplates = Template::select('id')->get();
        $allTemplatesID = array();
        foreach ($allTemplates as $Template) {
            array_push($allTemplatesID, $Template->id);
        }


        shuffle($allTemplatesID);
        session()->put('FirstTemplate',$allTemplatesID[0]);
        session()->put('SecondTemplate',$allTemplatesID[0]);
        session()->put('ThirdTemplate',$allTemplatesID[0]);

        if ($user->CurentTemplate != null) {
            session()->put('CurentTemplate',$user->CurentTemplate);
        }else {
            session()->put('CurentTemplate',$allTemplatesID[0]);
        }





        //Start Set Mine and Sub Color to Sessions
        session()->put('MineColor',$user->MineColor);
        session()->put('SubColor',$user->SubColor);
        session()->put('SocialText',$user->Instagram);
        //End Set Mine and Sub Color to Sessions


        //Start Set Images

         $UserImgs = Img::Select('TheImg')->where([['ImgType','Transparent'],['UserID',$UserID]])->get();
         session()->put('TransInputImage.image', []);
         foreach ($UserImgs as $TransparentImg) {
            if (strpos($TransparentImg->TheImg, 'png') !== false) {
                 $img = './img/storage/imgs/' . $TransparentImg->TheImg;
            }else {
                 $img = './img/storage/imgs/' . $TransparentImg->TheImg . '.png';
            }
            $img = Image::make($img);
            Response::make($img->encode('png'));
            session()->push('TransInputImage.image', $img);
       }

         $UserImgs = Img::Select('TheImg')->where([['ImgType','WithBackGound'],['UserID',$UserID]])->get();
         session()->put('WithBackInputImage.image', []);
         foreach ($UserImgs as $WithBackGound) {

            if (strpos($WithBackGound->TheImg, 'png') !== false) {
                 $img = './img/storage/imgs/' . $WithBackGound->TheImg;
            }else {
                 $img = './img/storage/imgs/' . $WithBackGound->TheImg . '.png';
            }
            $img = Image::make($img);
            Response::make($img->encode('png'));
            session()->push('WithBackInputImage.image',$img);
       }

      }
        //end if user come from control panel


    if ($request->has('changeTemplate')) {
        if ($CurentTemplate == $FirstTemplate ) {
            session()->put('CurentTemplate',$SecondTemplate);
        }elseif($CurentTemplate == $SecondTemplate) {
            session()->put('CurentTemplate',$ThirdTemplate);
        }elseif ($CurentTemplate == $ThirdTemplate) {
           session()->put('CurentTemplate',$FirstTemplate);
        }

    }



        if ($request->has('anotherTry')) {
           $numberOfTry = $request->anotherTry;
           $numberOfTry = $numberOfTry + 1 ;
           session()->put('CountOfTry',$numberOfTry);
        }


    //if user select template


    if ($request->has('TemplateID')) {
        session()->put('CurentTemplate',$request->TemplateID);
    }



        if (!is_null($request->Transparent) && !$request->has('oldUser')) {
           Session::forget('TransInputImage');
           session()->put('TransInputImage.image', []);
           foreach ($request->Transparent as $TransparentImg) {
                 $image_file = $TransparentImg;
                 $image = Image::make($image_file);
                 Response::make($image->encode('png'));
                 $request->session()->push('TransInputImage.image', $image);
         }

        }


        if (!is_null($request->WithBackGound) && !$request->has('oldUser')) {
           Session::forget('WithBackInputImage');
           session()->put('WithBackInputImage.image', []);
           foreach ($request->WithBackGound as $WithBackGoundImg) {
                 $image_file = $WithBackGoundImg;
                 $image = Image::make($image_file);
                 Response::make($image->encode('png'));
                 $request->session()->push('WithBackInputImage.image', $image);
             }

        }




        $rand = rand(0,50);

    return redirect('/try/form3?' . $rand);

}






public function createStep3(Request $request)
{



    //Uniq Folder For All User
    if ( session()->get('PhoneNumber') != null ) {
      $FolderPath = '/img/output/' . session()->get('PhoneNumber');
      session()->put('FolderPath',$FolderPath);

        if (!file_exists('.' .$FolderPath)) {
            mkdir('.' . $FolderPath, 0777, true);
        }
    }else {
      $FolderPath = '/img/output';
      session()->put('FolderPath',$FolderPath);
    }

    //new After file for A/B Testing

    $TestingType = session()->get('Testing');

      if ($TestingType == 'A' && $_SERVER['HTTP_REFERER'] == 'https://soouq.sa/try/form2') {
        $fname = './img/TestingType/A/after_send.txt';
        //Read count
        $fp = fopen($fname,'r');
        $count = fread($fp, filesize($fname));
        //conut
        $count = $count + 1;
        //write
        $fp = fopen($fname,'w');
        fwrite($fp, $count);

      }elseif ($TestingType == 'B' && $_SERVER['HTTP_REFERER'] == 'https://soouq.sa/try/form2') {
        $fname = './img/TestingType/B/after_send.txt';
        //Read count
        $fp = fopen($fname,'r');
        $count = fread($fp, filesize($fname));
        //conut
        $count = $count + 1;
        //write
        $fp = fopen($fname,'w');
        fwrite($fp, $count);
      }

      //end Testing A/B


    if (session()->get('CurentTemplate') != null) {
        $CurentTemplate = session()->get('CurentTemplate');
    }else {
         $CurentTemplate = session()->get('FirstTemplate');
    }


    $TemplateID = $CurentTemplate;
    $UserMineColor = session()->get('MineColor');
    $UserSubColor = session()->get('SubColor');
    $template = Template::all()->where('id',$TemplateID)->first();
    $InteractivePositions =  explode('-',$template->InteractivePositions);







    //check if user change color
    if ($UserMineColor != '#010101' || $UserSubColor != '#010101' ) {
       $changeColor = true;
   }else {
        //FORCE ALL BECOME CHANGE COLOR
       $changeColor = true;
   }


   if ($UserMineColor == '#010101' ) {
    $UserMineColor = $template->MineColor;
}

if ($UserSubColor == '#010101') {
    $UserSubColor = $template->SubColor;
}

/*
//START To Get All Enteractive Images

$BusinessType = session()->get('BusinessType');

// 1- Get Custom Enteractive
 $CustomEnteractive = Interactive::all()->where('Type',$BusinessType)->first();

// 2- Get Genral Enteractive
 $GenralEnteractive = Interactive::all()->where('Type','general')->first();
 //3- Get Friday Enteractive
 $FridayEnteractive = Interactive::all()->where('Type','Friday')->first();


*/

 //START To Get All Friday Images

// 1- Get Genral Enteractive


 $FridayEnteractiveG = Interactive::inRandomOrder()->select('TheImg')->where('FridayType','G')->first();
 // 2- Get Genral Enteractive
 $FridayEnteractiveH = Interactive::inRandomOrder()->select('TheImg')->where('FridayType','H')->first();
 // 3- Get Genral Enteractive
 $FridayEnteractiveD = Interactive::inRandomOrder()->select('TheImg')->where('FridayType','D')->first();

//End To Get All Enteractive Images





            // array to store all image path to call it in blade file
  $FolderPath = session()->get('FolderPath');
  $allImgPath = array();
  $allImgPathTrans = array();
  $allImgPathBack = array();



            // Function to copy alpha image to image
function imagecopymerge_alpha($dst_image ,$src_image ,$dst_x ,$dst_y ,$src_x ,$src_y ,$dst_w ,$dst_h ,$src_w ,$src_h ) {
    $cut = imagecreatetruecolor($src_w, $src_h);
    imagecopy($cut, $dst_image, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
    imagecopy($cut, $src_image, 0, 0, $src_x, $src_y, $src_w, $src_h);
    imagecopyresampled($dst_image, $cut, $dst_x, $dst_y,$src_x, $src_y, $dst_w, $dst_h,$src_w,$src_h);
}
            // get all Template image
$allTemplateImg = TemplateImg::select('id','imgType','TheImg','Blurry')->where('TemplateID',$TemplateID)->get();





    //Start Color




if ($changeColor == true ){

   foreach ($allTemplateImg as $index => $img) {


switch ($index) {
/*
  case $InteractivePositions[0]:
    $imgUrl = "./img/storage/interactives/". $FridayEnteractiveH->TheImg;
    list($rMineTemplate, $gMimeTemplate, $bMineTemplate) = sscanf('#710a0b', "#%02x%02x%02x");
    list($rSubTemplate, $gSubTemplate, $bSubTemplate) = sscanf('#FCE604', "#%02x%02x%02x");
    $imgIntractiveName = $img->id;
    break;
  case $InteractivePositions[1]:
    $imgUrl = "./img/storage/interactives/". $FridayEnteractiveG->TheImg;
    list($rMineTemplate, $gMimeTemplate, $bMineTemplate) = sscanf('#710a0b', "#%02x%02x%02x");
    list($rSubTemplate, $gSubTemplate, $bSubTemplate) = sscanf('#FCE604', "#%02x%02x%02x");
    $imgIntractiveName = $img->id;
    break;

  case 1:
    $imgUrl = "./img/storage/interactives/". $FridayEnteractiveD->TheImg;
    $imgE = imagecreatefrompng($imgUrl);
    $w = imagesx($imgE);
    $h = imagesy($imgE);
    imagesavealpha($imgE, true);

    $img2 = imagecreatefrompng('./img/storage/interactives/test.png');
    imagefilter($img2, IMG_FILTER_COLORIZE, 0,0,0,127*0.8);
    list($rMineTemplate, $gMimeTemplate, $bMineTemplate) = sscanf('#AD3C35', "#%02x%02x%02x");
   // imagefill($img2, 0, 0, imagecolorallocatealpha($imgE, $rMineTemplate,$gMimeTemplate, $bMineTemplate, 30));
$imgIntractiveName = $img->id;
    imagecopy($imgE, $img2, 0, 0, 0, 0, $w, $h);
    imagepng($imgE,'./' . $FolderPath . '/' .$imgIntractiveName .".png", 9);

    array_push($allImgPath,$imgIntractiveName);
    /*
    list($rMineTemplate, $gMimeTemplate, $bMineTemplate) = sscanf('#342f58', "#%02x%02x%02x");
    list($rSubTemplate, $gSubTemplate, $bSubTemplate) = sscanf('#332d57', "#%02x%02x%02x");



    break;

 */
  default:
    $imgUrl = "./img/storage/template_imgs/". $img->TheImg;
    list($rMineTemplate, $gMimeTemplate, $bMineTemplate) = sscanf($template->MineColor, "#%02x%02x%02x");
    list($rSubTemplate, $gSubTemplate, $bSubTemplate) = sscanf($template->SubColor, "#%02x%02x%02x");
    break;
}



    //get All image and Crate it as PNG
    $backImg = imagecreatefrompng($imgUrl);

    list($rMineUser, $gMineUser, $bMineUser) = sscanf($UserMineColor, "#%02x%02x%02x");
    list($rSubUser, $gSubUser, $bSubUser) = sscanf($UserSubColor, "#%02x%02x%02x");



    //make the imgae as platte mode to allow us change template color
    imagetruecolortopalette($backImg,false, 255);

    $indexx = imagecolorclosest($backImg,$rMineTemplate, $gMimeTemplate, $bMineTemplate);
    imagecolorset($backImg,$indexx,$rMineUser,$gMineUser,$bMineUser); // SET NEW COLOR

    $indexx = imagecolorclosest($backImg,$rSubTemplate, $gSubTemplate, $bSubTemplate);
    imagecolorset($backImg,$indexx,$rSubUser,$gSubUser,$bSubUser); // SET NEW COLOR

/*
    //after coloer finsh check if image has Blurry
    if ($img->Blurry == 'yes') {
        $BlurryImage = imagecreatefrompng('./img/Blurry.png');
        imagealphablending($BlurryImage, false); // imagesavealpha can only be used by doing this for some reason
        imagesavealpha($BlurryImage, true); // this one helps you keep the alpha.
        imagefilter($BlurryImage, IMG_FILTER_COLORIZE, 0,0,0,127*0.8);
        imagecopy($backImg, $BlurryImage, 0, 0, 0, 0, 1080, 1080);


    }
    */

    //difrent file foreache type
    $imgName =  $img->id;

    if ($img->imgType == 'Logo' || $img->imgType == 'Social') {
        imagepalettetotruecolor($backImg);
        imagepng($backImg, "./img/Unique/" . $imgName .".png", 9);

    }elseif($img->imgType == 'WithBackGound' || $img->imgType == 'Transparent') {
        imagecolortransparent($backImg,imagecolorat($backImg,500,500));
        imagealphablending($backImg, true);
        imagesavealpha($backImg, true);
        imagepng($backImg, "./img/NewItems/" . $imgName .".png", 9);
    }



 }


}


    //End Color


    //Strart Design


    //First Case => Transparent

        $uploadedTranparent =  count(session()->get('TransInputImage.image'));
        $countOFTransparent = TemplateImg::select('id')->where([['imgType','Transparent'],['TemplateID',$TemplateID]])->count();


        $allTransImg = array();
        $imges = session()->get('TransInputImage.image');

        foreach ($imges as $img) {
            $img = imagecreatefromstring($img);
            array_push($allTransImg,$img);
            //imagepng($img, "./img/all_images/" . rand(0,1000) .".png", 9);
        }

            //if user insert images less than transpernt template repetiton images
        if ($uploadedTranparent < $countOFTransparent) {
            for ($i=0; $i < $countOFTransparent - $uploadedTranparent ; $i++) {
                array_push($allTransImg,$allTransImg[$i]);
            }

        }

        $TransparentinDesign = TemplateImg::select('TheImg','id','Blurry')->where([['imgType','Transparent'],['TemplateID',$TemplateID]])->get();

        //start copy
  foreach ($TransparentinDesign as $index => $trans) {

                  if (!in_array($trans->id,$allImgPath)) {
                              if ($changeColor == true) {
                    $backImg = imagecreatefrompng('./img/NewItems/' . $trans->id . '.png');
                }else {
                    $imgUrl = "http://$_SERVER[HTTP_HOST]/admin/templateImg/fetch_image/". $trans->id;
                    $backImg = imagecreatefrompng($imgUrl);
                }



              //  $allWithBack[$index] = imagescale($allWithBack[$index] ,imagesx($backImg) ,imagesx($backImg));

                $height = imagesy($allTransImg[$index]);
                $width = imagesx($allTransImg[$index]);
                if ( $width > 1080 || $height > 1080) {

                  if ($width > $height) {
                      $y = 0;
                      $x = ($width - $height) / 2;
                      $smallestSide = $height;
                    } else {
                      $x = 0;
                      $y = ($height - $width) / 2;
                      $smallestSide = $width;
                }

                $thumbSize = 1080;
                $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
                imagecopyresampled($thumb, $allTransImg[$index], 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
                imagecopymerge_alpha($thumb,$backImg, 0, 0, 0, 0,1080,1080, imagesx($backImg), imagesy($backImg));
                $imgName = $trans->id;

                //After copy done check if post has bulrry
                if ($trans->Blurry == 'yes') {
                    $BlurryImage = imagecreatefrompng('./img/Blurry.png');
                    imagefilter($BlurryImage, IMG_FILTER_COLORIZE, 0,0,0,127*0.8);
                    imagecopy($thumb, $BlurryImage, 0, 0, 0, 0, 1080, 1080);
                }

                imagepng($thumb,'.' . $FolderPath  . '/' . $imgName .".png", 9);

                }else {
                $allTransImg[$index] = imagescale($allTransImg[$index] ,imagesx($backImg) ,imagesx($backImg));
                imagecopymerge_alpha($allTransImg[$index], $backImg, 0, 0, 0, 0,imagesx($allTransImg[$index]),imagesy($allTransImg[$index]), imagesx($backImg), imagesy($backImg));
                $imgName = $trans->id;
                //After copy done check if post has bulrry
                if ($trans->Blurry == 'yes') {
                    $BlurryImage = imagecreatefrompng('./img/Blurry.png');
                    imagefilter($BlurryImage, IMG_FILTER_COLORIZE, 0,0,0,127*0.8);
                    imagecopy($allTransImg[$index], $BlurryImage, 0, 0, 0, 0, 1080, 1080);
                }

                imagepng($allTransImg[$index], '.' . $FolderPath  . '/' . $imgName .".png", 9);


                }
                array_push($allImgPath,$imgName);
                array_push($allImgPathTrans,$imgName);
            }

}






            //second case = > With Back

        $uploadedWithBackGround =  count(session()->get('WithBackInputImage.image'));
        $countOFWithBackGround = TemplateImg::select('id')->where([['imgType','WithBackGound'],['TemplateID',$TemplateID]])->count();


        $allWithBack = array();
        $imges = session()->get('WithBackInputImage.image');
        foreach ($imges as $img) {
            $img = imagecreatefromstring($img);
            array_push($allWithBack,$img);

           // imagepng($img, "./img/all_images/" . rand(0,1000) .".png", 9);
        }


                        //if user insert images less than transpernt template repetiton images
        if ($uploadedWithBackGround < $countOFWithBackGround) {

            for ($i=0; $i < $countOFWithBackGround - $uploadedWithBackGround ; $i++) {
                array_push($allWithBack,$allWithBack[$i]);
            }

        }

        $WithBackinDesign = TemplateImg::select('TheImg','id','Blurry')->where([['imgType','WithBackGound'],['TemplateID',$TemplateID]])->get();

            foreach ($WithBackinDesign as $index => $wtihBack) {

                  if (!in_array($wtihBack->id,$allImgPath)) {
                              if ($changeColor == true) {
                    $backImg = imagecreatefrompng('./img/NewItems/' . $wtihBack->id . '.png');
                }else {
                    $imgUrl = "http://$_SERVER[HTTP_HOST]/admin/templateImg/fetch_image/". $wtihBack->id;
                    $backImg = imagecreatefrompng($imgUrl);
                }



              //  $allWithBack[$index] = imagescale($allWithBack[$index] ,imagesx($backImg) ,imagesx($backImg));

                $height = imagesy($allWithBack[$index]);
                $width = imagesx($allWithBack[$index]);
                if ( $width > 1080 || $height > 1080) {

                  if ($width > $height) {
                      $y = 0;
                      $x = ($width - $height) / 2;
                      $smallestSide = $height;
                    } else {
                      $x = 0;
                      $y = ($height - $width) / 2;
                      $smallestSide = $width;
                }

                $thumbSize = 1080;
                $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
                imagecopyresampled($thumb, $allWithBack[$index], 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);
                imagecopymerge_alpha($thumb,$backImg, 0, 0, 0, 0,1080,1080, imagesx($backImg), imagesy($backImg));
                $imgName = $wtihBack->id;
                //After copy done check if post has bulrry
                if ($wtihBack->Blurry == 'yes') {
                    $BlurryImage = imagecreatefrompng('./img/Blurry.png');
                    imagefilter($BlurryImage, IMG_FILTER_COLORIZE, 0,0,0,127*0.8);
                    imagecopy($thumb, $BlurryImage, 0, 0, 0, 0, 1080, 1080);
                }

                imagepng($thumb,'.' . $FolderPath  . '/' . $imgName .".png", 9);

                }else {
                $allWithBack[$index] = imagescale($allWithBack[$index] ,imagesx($backImg) ,imagesx($backImg));
                imagecopymerge_alpha($allWithBack[$index], $backImg, 0, 0, 0, 0,imagesx($allWithBack[$index]),imagesy($allWithBack[$index]), imagesx($backImg), imagesy($backImg));
                $imgName = $wtihBack->id;
                //After copy done check if post has bulrry
                if ($wtihBack->Blurry == 'yes') {
                    $BlurryImage = imagecreatefrompng('./img/Blurry.png');
                    imagefilter($BlurryImage, IMG_FILTER_COLORIZE, 0,0,0,127*0.8);
                    imagecopy($allWithBack[$index], $BlurryImage, 0, 0, 0, 0, 1080, 1080);
                }

                imagepng($allWithBack[$index], '.' . $FolderPath  . '/' . $imgName .".png", 9);


                }
                array_push($allImgPath,$imgName);
                array_push($allImgPathBack,$imgName);
            }

}


    // Third Case Logo
        $logoAsImage = imagecreatefromstring(session()->get('logoAsImage'));
        $LogoinDesign = TemplateImg::select('TheImg','id','Blurry')->where([['imgType','Logo'],['TemplateID',$TemplateID]])->get();

        //start copy
        foreach ($LogoinDesign as $index => $logo) {

            if (!in_array($logo->id,$allImgPath)) {

                if ($changeColor == true) {
                    $backImg = imagecreatefrompng('./img/Unique/' . $logo->id . '.png');

                }else {
                    $backImg = imagecreatefromstring($logo->TheImg);
                }

               //set width and height to image and make it at center
            if (imagesx($logoAsImage) <= imagesx($backImg) && imagesy($logoAsImage) <= imagesy($backImg)) {
                //rate of descree from mine image if was it less than template size

                $decRate = (imagesx($backImg) * 5) / 100;
                $new_widht =  imagesx($backImg) - $decRate;
                $new_height =  (imagesy($backImg) - ($decRate));
                $xoffset = (imagesx($backImg) -  $new_widht) / 2;
                $yoffset = (imagesy($backImg)  -   $new_height) / 2;

            }else {
                $decRate = (imagesx($backImg) * 35) / 100;
                $new_widht =  imagesx($backImg) - $decRate;
                $new_height = imagesy($backImg) - $decRate;
                $xoffset = (imagesx($backImg) -  $new_widht) / 2;
                $yoffset = (imagesy($backImg)  -   $new_height) / 2;
            }

            imagecopyresampled($backImg, $logoAsImage,  $xoffset, $yoffset, 0, 0,$new_widht,$new_height, imagesx($logoAsImage), imagesy($logoAsImage));
            $imgName = $logo->id;
             //After copy done check if post has bulrry
            if ($logo->Blurry == 'yes') {
                $BlurryImage = imagecreatefrompng('./img/Blurry.png');
                imagefilter($BlurryImage, IMG_FILTER_COLORIZE, 0,0,0,127*0.8);
                imagecopy($backImg, $BlurryImage, 0, 0, 0, 0, 1080, 1080);
            }
            imagepng($backImg, '.' . $FolderPath . '/' . $imgName .".png", 9);
            array_push($allImgPath,$imgName);

        }

 }


     // Forth Case Logos
        $SocialinDesign = TemplateImg::select('TheImg','id','Blurry')->where([['imgType','Social'],['TemplateID',$TemplateID]])->get();

        //start Write
        foreach ($SocialinDesign as $index => $soical) {
            if (!in_array($soical->id,$allImgPath)) {
                $backImg = imagecreatefrompng('./img/Unique/' . $soical->id . '.png');
                $font =  realpath('./font/ae_AlHor.ttf');
                $color = imagecolorallocate($backImg, 0, 0, 0);
                $SocialText = session::get('SocialText');
                if ($SocialText != null) {
                    $text = $SocialText;
                }else{
                    $text = 'Soouq_sa';
                }
                imagettftext($backImg, 50, 0, 310, 380, $color, $font,$text);
                $imgName = $soical->id;
                imagepng($backImg, '.' . $FolderPath . '/' . $imgName .".png", 9);
                array_push($allImgPath,$imgName);
                 //After Write done check if post has bulrry
                if ($soical->Blurry == 'yes') {
                    $BlurryImage = imagecreatefrompng('./img/Blurry.png');
                    imagefilter($BlurryImage, IMG_FILTER_COLORIZE, 0,0,0,127*0.8);
                    imagecopy($backImg, $BlurryImage, 0, 0, 0, 0, 1080, 1080);
                }
        }
 }



      sort($allImgPath);


      session()->put('allImgPath.path', []);
      session()->put('allImgPathTrans.path', []);
      session()->put('allImgPathBack.path', []);



        foreach ($allImgPath as $key => $img) {
            session()->push('allImgPath.path', $img);
        }
        foreach ($allImgPathTrans as $key => $img) {
            session()->push('allImgPathTrans.path', $img);
        }
        foreach ($allImgPathBack as $key => $img) {
            session()->push('allImgPathBack.path', $img);
        }



            $myfile = fopen('./img/TestingType/' . session()->get('PhoneNumber'). ".txt", "w") or die("Unable to open file!");
            fwrite($myfile, session::get('Testing'));
            fclose($myfile);

            //GET ALL TEMPLATE FOR USER CHOSE ONE OF THEM

            if ($uploadedWithBackGround == 0) {
              $allTemplates = Template::select('id','TemplateBackGroundName')->where('TemplateType','Transparent')->get();
            }elseif ($uploadedTranparent == 0) {
              $allTemplates = Template::select('id','TemplateBackGroundName')->where('TemplateType','WithBackGound')->get();
            }else {
               $allTemplates = Template::select('id','TemplateBackGroundName')->get();
            }

            $FirstTemplateID = $TemplateID;


            $LogoColors = session()->get('LogoColors.color');


        return view('try.step3',compact('allImgPath','UserMineColor','UserSubColor','FolderPath','allTemplates','FirstTemplateID','LogoColors'));
    }




    public function PostcreateStep3(Request $request)
    {



         $request->validate([
          'email'  => 'unique:users,email',
      ]);


       $UserMineColor = session()->get('MineColor');
       $UserSubColor = session()->get('SubColor');
       $Instagram = session()->get('Instagram');
       $PhoneNumber = session()->get('PhoneNumber');
       $Twitter = session()->get('Twitter');
       $BusinessType = session()->get('BusinessType');
       $CurentTemplate = session()->get('CurentTemplate');
       $TestingType = session()->get('Testing');

$user = new User();



$user->name =  $request->name;
$user->email =  $request->email;
$user->PhoneNumber =  $request->PhoneNumber;
$user->password =  Crypt::encrypt(($request->password));
$user->Twitter =  $Twitter;
$user->Instagram =  $Instagram;
$user->BusinessType =  $BusinessType;
$user->CurentTemplate =  $CurentTemplate;
$user->TestingType =  $TestingType;
$user->MineColor =  $UserMineColor;
$user->SubColor =  $UserSubColor;
$user->save();


$UserID = $user->id;

    //save img
       foreach ($request->session()->get('TransInputImage.image') as $img) {
        $img = imagecreatefromstring($img);
        imagealphablending($img, false);
        imagesavealpha($img, true);
        $imageName = rand(0,50000). '.png';
        imagepng($img,"./img/storage/imgs/". $imageName , 9);
           $form_data = array(
              'UserID'  => $UserID,
              'ImgType'  => 'Transparent',
              'TheImg' => $imageName
          );
           Img::create($form_data);
       }


       foreach ($request->session()->get('WithBackInputImage.image') as $img) {

            $img = imagecreatefromstring($img);
            $imageName = rand(0,50000) . '.png';
            imagepng($img,"./img/storage/imgs/". $imageName , 9);
           $form_data = array(
              'UserID'  => $UserID,
              'ImgType'  => 'WithBackGound',
              'TheImg' => $imageName
          );
           Img::create($form_data);

       }






       $FolderPath = session()->get('FolderPath');


        //reseve to suclude
        $reverseImageOrder = array_reverse(session()->get('allImgPath.path'));

       //save design
       foreach ($reverseImageOrder as $key => $img) {
           $image_file = '.' . $FolderPath  . '/' . $img . '.png';
           $image = Image::make($image_file);
           Response::make($image->encode('png'));
           $image = imagecreatefromstring($image);
           $imageName = $key + 1 . '_['. Date('yy:m:d', strtotime('+' . $key + 2 .'days')).']' . $UserID;
           imagepng($image,"./img/storage/user_designs/". $imageName .".png", 9);
           $form_data = array(
              'UserID'  => $UserID,
              'TheImg' => $imageName,
              'DesignID' =>$img,
          );
           UserDesign::create($form_data);
       }


       //save IMGID


        $allUserimagID = Img::select('id')->where([['imgType','Transparent'],['UserID',$UserID]])->get();
        $uploadedTranparent =  count($allUserimagID);
        $countOFTransparent = TemplateImg::select('id')->where([['imgType','Transparent'],['TemplateID',session()->get('CurentTemplate')]])->count();


        $allUserimagIDArray = array();
        $imges = session()->get('TransInputImage.image');
        foreach ($allUserimagID as $id) {
            array_push($allUserimagIDArray,$id->id);
        }
        if ($uploadedTranparent < $countOFTransparent) {

            for ($i=0; $i < $countOFTransparent - $uploadedTranparent ; $i++) {
                array_push($allUserimagIDArray,$allUserimagIDArray[$i]);
            }

        }


         foreach (session()->get('allImgPathTrans.path') as $n => $img) {
          $ImgID = UserDesign::select('id')->where(([['DesignID',$img],['UserID',$UserID]]))->get();
          $imgDesign = UserDesign::find($ImgID)->first();

           $form_data = array(
              'ImgID' =>$allUserimagIDArray[$n]
          );
           $imgDesign->update($form_data);
       }






        $allUserimagID = Img::select('id')->where([['imgType','WithBackGound'],['UserID',$UserID]])->get();
        $uploadedWithBackGround =  count($allUserimagID);
        $countOFWithBackGround = TemplateImg::select('id')->where([['imgType','WithBackGound'],['TemplateID',session()->get('CurentTemplate')]])->count();


        $allUserimagIDArray = array();
        $imges = session()->get('WithBackInputImage.image');
        foreach ($allUserimagID as $id) {
            array_push($allUserimagIDArray,$id->id);
        }
        if ($uploadedWithBackGround < $countOFWithBackGround) {

            for ($i=0; $i < $countOFWithBackGround - $uploadedWithBackGround ; $i++) {
                array_push($allUserimagIDArray,$allUserimagIDArray[$i]);
            }

        }


         foreach (session()->get('allImgPathBack.path') as $n => $img) {
          $ImgID = UserDesign::select('id')->where(([['DesignID',$img],['UserID',$UserID]]))->get();
          $imgDesign = UserDesign::find($ImgID)->first();

           $form_data = array(
              'ImgID' =>$allUserimagIDArray[$n]
          );
           $imgDesign->update($form_data);
       }

       //deleta all images from folder


       Auth::loginUsingId($UserID, true);

       session()->forget('TransInputImage');
       session()->forget('WithBackInputImage');

        return Redirect::route('home', array('St' => 'N'));

    }


   public function submit(Request $request) {


     $form_data = array(
          'Nots'  => $request->Nots,
          'PhoneNumber' =>session()->get('PhoneNumber'),
      );
         Nots::create($form_data);
   }


   public function PostcreateStep4 (Request $request) {
    $UserID = Auth::id();

    //delete old design
    DB::table('user_designs')
    ->where('UserID', $UserID)
    ->delete();

$FolderPath = session()->get('FolderPath');


    //save New Design
   foreach (session()->get('allImgPath.path') as $key => $img) {
       $image_file ='.' . $FolderPath  . '/' . $img . '.png';
       $image = Image::make($image_file);
       Response::make($image->encode('png'));
        $image = imagecreatefromstring($image);
        $imageName = rand(0,5000000);
        imagepng($image,"./img/storage/user_designs/". $imageName .".png", 9);
       $form_data = array(
          'UserID'  => $UserID,
          'TheImg' => $imageName,
          'DesignID' =>$img
      );
       UserDesign::create($form_data);
   }
    $form_data = array(
        'CurentTemplate' => session::get('CurentTemplate'),
        'MineColor' => session::get('MineColor'),
        'SubColor' => session::get('SubColor'),
    );
    $user = User::find($UserID);
    $user->update($form_data);



    //Save IMG ID

        $allUserimagID = Img::select('id')->where([['imgType','Transparent'],['UserID',$UserID]])->get();
        $uploadedTranparent =  count($allUserimagID);
        $countOFTransparent = TemplateImg::select('id')->where([['imgType','Transparent'],['TemplateID',session()->get('CurentTemplate')]])->count();


        $allUserimagIDArray = array();
        $imges = session()->get('TransInputImage.image');
        foreach ($allUserimagID as $id) {
            array_push($allUserimagIDArray,$id->id);
        }
        if ($uploadedTranparent < $countOFTransparent) {
            for ($i=0; $i < $countOFTransparent - $uploadedTranparent ; $i++) {
                array_push($allUserimagIDArray,$allUserimagIDArray[$i]);
            }

        }


         foreach (session()->get('allImgPathTrans.path') as $n => $img) {
          $ImgID = UserDesign::select('id')->where(([['DesignID',$img],['UserID',$UserID]]))->get();
          $imgDesign = UserDesign::find($ImgID)->first();
           $form_data = array(
              'ImgID' => $allUserimagIDArray[$n]
          );
           $imgDesign->update($form_data);
       }







        $allUserimagID = Img::select('id')->where([['imgType','WithBackGound'],['UserID',$UserID]])->get();
        $uploadedWithBackGround =  count($allUserimagID);
        $countOFWithBackGround = TemplateImg::select('id')->where([['imgType','WithBackGound'],['TemplateID',session()->get('CurentTemplate')]])->count();


        $allUserimagIDArray = array();
        $imges = session()->get('WithBackInputImage.image');
        foreach ($allUserimagID as $id) {
            array_push($allUserimagIDArray,$id->id);
        }
        if ($uploadedWithBackGround < $countOFWithBackGround) {

            for ($i=0; $i < $countOFWithBackGround - $uploadedWithBackGround ; $i++) {
                array_push($allUserimagIDArray,$allUserimagIDArray[$i]);
            }

        }


         foreach (session()->get('allImgPathBack.path') as $n => $img) {
          $ImgID = UserDesign::select('id')->where(([['DesignID',$img],['UserID',$UserID]]))->get();
          $imgDesign = UserDesign::find($ImgID)->first();

           $form_data = array(
              'ImgID' =>$allUserimagIDArray[$n]
          );
           $imgDesign->update($form_data);
    //End IMG ID

  return Redirect::route('home', array('St' => 'N'));


   }



}

}
