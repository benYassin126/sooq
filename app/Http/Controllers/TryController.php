<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Img;
use App\TemplateImg;
use App\Template;
use App\Nots;
use App\User;
use App\UserDesign;
use Image;
use Auth;
use Redirect;
use DB;
use Session;



class TryController extends Controller
{
    public function index() {
        return view('try.index');
    }

    public function createStep1(Request $request)
    {
        $try = $request->session()->get('try');
        return view('try.step1',compact('try'));
    }

    public function PostcreateStep1(Request $request)
    {

        $validatedData =  $request->validate([
          'Transparent.*' => 'required|image|max:10240',
          'WithBackGound.*' => 'required|image|max:10240',

      ]);


        session()->put('TransInputImage.image', []);
        session()->put('WithBackInputImage.image', []);

        //chose two random template
        $allTemplates = Template::select('id')->get();
        $allTemplatesID = array();
        foreach ($allTemplates as $Template) {
            array_push($allTemplatesID, $Template->id);
        }
        $randomKay = array_rand($allTemplatesID,2);
        session()->put('FirstTemplate',$allTemplatesID[$randomKay[0]]);
        session()->put('SecondTemplate',$allTemplatesID[$randomKay[1]]);
        session()->put('CurentTemplate',session()->get('FirstTemplate'));





        if ($request->has('Transparent') && $request->has('WithBackGound')  ) {

         foreach ($request->Transparent as $TransparentImg) {
             $image_file = $TransparentImg;
             $image = Image::make($image_file);
             Response::make($image->encode('png'));
             $request->session()->push('TransInputImage.image', $image);
         }

         foreach ($request->WithBackGound as $WithBackGoundImg) {
             $image_file = $WithBackGoundImg;
             $image = Image::make($image_file);
             Response::make($image->encode('png'));
             $request->session()->push('WithBackInputImage.image', $image);
         }

     }

     Session::put('step1', 1);
     return redirect('/try/form2');
 }

 public function createStep2(Request $request)
 {
    /*
    if(!Session::has('step1') || Session::get('step1') != 1) {
        return Redirect::to('try/form1');
    }
    */
    return view('try.step2');
}

public function PostcreateStep2(Request $request)
{


    if ($request->has('BusinessType')) {
       session()->put('BusinessType',$request->BusinessType);

    }

    if ($request->has('OtherBusinessType') && $request->OtherBusinessType !=null ) {
       session()->put('BusinessType',$request->OtherBusinessType );
    }



    if ($request->has('Twitter')) {
       session()->put('Twitter',$request->Twitter );
    }

    if ($request->has('Instagram')) {
       session()->put('Instagram',$request->Instagram );
    }
    if ($request->has('MineColor')) {
           session()->put('MineColor',$request->MineColor );
        }

    if ($request->has('SubColor')) {
            session()->put('SubColor',$request->SubColor );
        }


    $FirstTemplate = session()->get('FirstTemplate');//47
    $SecondTemplate = session()->get('SecondTemplate');//48
    $CurentTemplate = session()->get('CurentTemplate');//47


    if ($request->has('changeTemplate')) {
        if ($CurentTemplate == $FirstTemplate ) {
            session()->put('CurentTemplate',$SecondTemplate);
        }else {
            session()->put('CurentTemplate',$FirstTemplate);
        }

    }



        //if user come from control panel

      if ($request->has('oldUser')) {

        $UserID = $request->UserID;
        $user = User::select('MineColor','SubColor')->where('id',$UserID)->first();
    //    dd($user);


        //Start chose two random template
        $allTemplates = Template::select('id')->get();
        $allTemplatesID = array();
        foreach ($allTemplates as $Template) {
            array_push($allTemplatesID, $Template->id);
        }
        $randomKay = array_rand($allTemplatesID,2);
        session()->put('FirstTemplate',$allTemplatesID[$randomKay[0]]);
        session()->put('SecondTemplate',$allTemplatesID[$randomKay[1]]);
        session()->put('CurentTemplate',session()->get('FirstTemplate'));
        //End chose two random template

        //Start Set Mine and Sub Color to Sessions
        session()->put('MineColor',$user->MineColor );
        session()->put('SubColor',$user->SubColor );

        //Start Set Images

         $UserImgs = Img::Select('TheImg')->where([['ImgType','Transparent'],['UserID',$UserID]])->get();
         session()->put('TransInputImage.image', []);
         foreach ($UserImgs as $TransparentImg) {

               session()->push('TransInputImage.image', $TransparentImg->TheImg);
       }

         $UserImgs = Img::Select('TheImg')->where([['ImgType','WithBackGound'],['UserID',$UserID]])->get();
         session()->put('WithBackGound.image', []);
         foreach ($UserImgs as $WithBackGound) {
               session()->push('WithBackInputImage.image', $WithBackGound->TheImg);
       }




        //End Set Mine and Sub Color to Sessions

      }





      if ($request->has('changeTemplate')) {
          if ($CurentTemplate == $FirstTemplate ) {
              session()->put('CurentTemplate',$SecondTemplate);
          }else {
              session()->put('CurentTemplate',$FirstTemplate);
          }

      }


        if ($request->has('anotherTry')) {

           $numberOfTry = $request->anotherTry;
           $numberOfTry = $numberOfTry + 1 ;
           session()->put('CountOfTry',$numberOfTry);
        //  dd($numberOfTry);
        }else {
           session()->put('CountOfTry',0);
        }


        if (!is_null($request->Transparent)) {

           Session::forget('TransInputImage');
           session()->put('TransInputImage.image', []);
           foreach ($request->Transparent as $TransparentImg) {
                 $image_file = $TransparentImg;
                 $image = Image::make($image_file);
                 Response::make($image->encode('png'));
                 $request->session()->push('TransInputImage.image', $image);
         }

        }


        if (!is_null($request->WithBackGound)) {
           Session::forget('WithBackGound');
           session()->put('WithBackGound.image', []);
           foreach ($request->WithBackGound as $WithBackGoundImg) {
                 $image_file = $WithBackGoundImg;
                 $image = Image::make($image_file);
                 Response::make($image->encode('png'));
                 $request->session()->push('WithBackInputImage.image', $image);
             }

        }










    return redirect('/try/form3');
}






public function createStep3(Request $request)
{







    if (session()->get('CurentTemplate') != null) {
        $CurentTemplate = session()->get('CurentTemplate');
    }else {
         $CurentTemplate = session()->get('FirstTemplate');
    }

    $SessinID = substr( Session::getId(), -3);

    $TemplateID = $CurentTemplate;
    $UserMineColor = session()->get('MineColor');
    $UserSubColor = session()->get('SubColor');

    $template = Template::all()->where('id',$TemplateID)->first();



        //check if user change color
    if ($UserMineColor != '#010101' || $UserSubColor != '#010101' ) {
       $changeColor = true;
   }else {
       $changeColor = false;
   }


   if ($UserMineColor == '#010101' ) {
    $UserMineColor = $template->MineColor;
}

if ($UserSubColor == '#010101') {
    $UserSubColor = $template->SubColor;
}







            // array to store all image path to call it in blade file
$allImgPath = array();

            // Function to copy alpha image to image
function imagecopymerge_alpha($dst_image ,$src_image ,$dst_x ,$dst_y ,$src_x ,$src_y ,$dst_w ,$dst_h ,$src_w ,$src_h ) {
    $cut = imagecreatetruecolor($src_w, $src_h);
    imagecopy($cut, $dst_image, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
    imagecopy($cut, $src_image, 0, 0, $src_x, $src_y, $src_w, $src_h);
    imagecopyresampled($dst_image, $cut, $dst_x, $dst_y,$src_x, $src_y, $dst_w, $dst_h,$src_w,$src_h);
}
            // get all Template image
$allTemplateImg = TemplateImg::select('id','imgType')->where('TemplateID',$TemplateID)->get();

if ($changeColor == true ){

   foreach ($allTemplateImg as $index => $img) {
                //get All image and Crate it as PNG
    $imgUrl = "http://$_SERVER[HTTP_HOST]/admin/templateImg/fetch_image/". $img->id;
    $backImg = imagecreatefrompng($imgUrl);

                //store RGB colors to change template color
    list($rMineTemplate, $gMimeTemplate, $bMineTemplate) = sscanf($template->MineColor, "#%02x%02x%02x");
    list($rMineUser, $gMineUser, $bMineUser) = sscanf($UserMineColor, "#%02x%02x%02x");
    list($rSubTemplate, $gSubTemplate, $bSubTemplate) = sscanf($template->SubColor, "#%02x%02x%02x");
    list($rSubUser, $gSubUser, $bSubUser) = sscanf($UserSubColor, "#%02x%02x%02x");
    list($rSubSubTemplate, $gSubSubTemplate, $bSubSubTemplate) = sscanf($template->SubSubColor, "#%02x%02x%02x");


                //make the imgae as platte mode to allow us change template color
    imagetruecolortopalette($backImg,false, 255);
    $indexx = imagecolorclosest($backImg,$rMineTemplate, $gMimeTemplate, $bMineTemplate);
                imagecolorset($backImg,$indexx,$rMineUser,$gMineUser,$bMineUser); // SET NEW COLOR
                $indexx = imagecolorclosest($backImg,$rSubTemplate, $gSubTemplate, $bSubTemplate);
                imagecolorset($backImg,$indexx,$rSubUser,$gSubUser,$bSubUser); // SET NEW COLOR
                $indexx = imagecolorclosest($backImg,$rSubSubTemplate, $gSubSubTemplate, $bSubSubTemplate);
                imagecolorset($backImg,$indexx,$rMineUser,$gMineUser,$bMineUser); // SET NEW COLOR

                //difrent file foreache type
                $imgName = "Template" . $img->id;
                if ($img->imgType == 'Transparent') {
                    imagepalettetotruecolor($backImg);
                    imagepng($backImg, "./img/newTemplateTrans/" . $imgName .".png", 9);
                    //dd('Template Mine Color',$template->MineColor,'User Color',$UserMineColor);
                }else {
                    imagecolortransparent($backImg,imagecolorat($backImg,500,500));
                    imagealphablending($backImg, true);
                    imagesavealpha($backImg, true);
                    imagepng($backImg, "./img/newTemplateBack/" . $imgName .".png", 9);
                }


            }


        }








        $uploadedTranparent =  count(session()->get('TransInputImage'));

        $countOFTransparent = TemplateImg::select('id')->where([['imgType','Transparent'],['TemplateID',$TemplateID]])->count();


        $allTransImg = array();
        $imges = session()->get('TransInputImage.image');
        foreach ($imges as $img) {
            $img = imagecreatefromstring($img);
            array_push($allTransImg,$img);
        }


            //if user insert images less than transpernt template repetiton images
        if ($uploadedTranparent < $countOFTransparent) {

            for ($i=0; $i < $countOFTransparent - $uploadedTranparent ; $i++) {
                array_push($allTransImg,$allTransImg[$i]);
            }

        }

        $TransparentinDesign = TemplateImg::select('TheImg','id')->where([['imgType','Transparent'],['TemplateID',$TemplateID]])->get();

        foreach ($TransparentinDesign as $index => $trns) {
            if ($changeColor == true) {
                $backImg = imagecreatefrompng('./img/newTemplateTrans/Template' . $trns->id . '.png');

            }else {
                $backImg = imagecreatefromstring($trns->TheImg);
            }



                            //set width and height to image and make it at center
            if (imagesx($allTransImg[$index]) <= imagesx($backImg) && imagesy($allTransImg[$index]) <= imagesy($backImg)) {
                                //rate of descree from mine image if was it less than template size
                $decRate = (imagesx($backImg) * 20) / 100;
                $new_widht =  imagesx($backImg) - $decRate;
                $new_height =  (imagesy($backImg) - ($decRate + 90));
                $xoffset = (imagesx($backImg) -  $new_widht) / 2;
                $yoffset = (imagesy($backImg)  -   $new_height) / 2;

            }else {
                $decRate = (imagesx($backImg) * 35) / 100;
                $new_widht =  imagesx($backImg) - $decRate;
                $new_height = imagesy($backImg) - $decRate;
                $xoffset = (imagesx($backImg) -  $new_widht) / 2;
                $yoffset = (imagesy($backImg)  -   $new_height) / 2;
            }

            imagecopyresampled($backImg, $allTransImg[$index],  $xoffset, $yoffset, 0, 0,$new_widht,$new_height, imagesx($allTransImg[$index]), imagesy($allTransImg[$index]));


           // $imgName = $trns->id;
           // $imgName = $trns->id . '__'. $SessinID;
            $imgName = $trns->id;
          //  dd($imgName);
            imagepng($backImg, "./img/output/" . $imgName .".png", 9);
            array_push($allImgPath,$imgName);


        }



            //second case


        $uploadedWithBackGround =  count(session()->get('WithBackInputImage'));

        $countOFWithBackGround = TemplateImg::select('id')->where([['imgType','WithBackGound'],['TemplateID',$TemplateID]])->count();


        $allWithBack = array();
        $imges = session()->get('WithBackInputImage.image');
        foreach ($imges as $img) {
            $img = imagecreatefromstring($img);
            array_push($allWithBack,$img);
        }


                        //if user insert images less than transpernt template repetiton images
        if ($uploadedWithBackGround < $countOFWithBackGround) {

            for ($i=0; $i < $countOFWithBackGround - $uploadedWithBackGround ; $i++) {
                array_push($allWithBack,$allWithBack[$i]);
            }

        }

        $WithBackinDesign = TemplateImg::select('TheImg','id')->where([['imgType','WithBackGound'],['TemplateID',$TemplateID]])->get();

        foreach ($WithBackinDesign as $index => $wtihBack) {

            if ($changeColor == true) {
                $backImg = imagecreatefrompng('./img/newTemplateBack/Template' . $wtihBack->id . '.png');
            }else {
                $imgUrl = "http://$_SERVER[HTTP_HOST]/admin/templateImg/fetch_image/". $wtihBack->id;
                $backImg = imagecreatefrompng($imgUrl);
            }

            $allWithBack[$index] = imagescale($allWithBack[$index] ,imagesx($backImg) ,imagesx($backImg));
            imagecopymerge_alpha($allWithBack[$index], $backImg, 0, 0, 0, 0,imagesx($allWithBack[$index]),imagesy($allWithBack[$index]), imagesx($backImg), imagesy($backImg));



           $imgName = $wtihBack->id;
            imagepng($allWithBack[$index], "./img/output/" . $imgName .".png", 9);
            array_push($allImgPath,$imgName);


        }

        sort($allImgPath);



      session()->put('allImgPath.path', []);

        foreach ($allImgPath as $key => $img) {

            rename('./img/output/' . $img . '.png' , './img/output/[' . ($key + 1) .']__' . $SessinID  . '.png');
            $newImgName = "[" . ($key + 1) ."]__" . $SessinID;
            session()->push('allImgPath.path', $newImgName);
        }




        /*
            Session::forget('MineColor');
            Session::forget('SubColor');
           Session::forget('WithBackInputImage');
           Session::forget('TransInputImage');
                      Session::forget('step1');
           Session::forget('step2');
           */

        return view('try.step3',compact('allImgPath'));
    }















    public function PostcreateStep3(Request $request)
    {




     // dd($UserMineColor,$UserSubColor,$Instagram,$Twitter,$BusinessType);
      //  dd($request->BusinessType);


         $request->validate([
          'email'  => 'unique:Users,email',
      ]);


         /*
         $form_data = array(
          'name'  => $request->name,
          'email'  => $request->email,
          'password' => encrypt($request->password),
          'Twitter' => $Twitter,
          'Instagram' => $Instagram,
          'BusinessType' => $BusinessType,
          'MineColor' => $UserMineColor,
          'SubColor' => $UserSubColor,
      );

      */


       $UserMineColor = session()->get('MineColor');
       $UserSubColor = session()->get('SubColor');
       $Instagram = session()->get('Instagram');
       $Twitter = session()->get('Twitter');
       $BusinessType = session()->get('BusinessType');

$user = new User();


//dd(session()->get('BusinessType'));

$user->name =  $request->name;
$user->email =  $request->email;
$user->password =  encrypt($request->password);
$user->Twitter =  $Twitter;
$user->Instagram =  $Instagram;
$user->BusinessType =  $BusinessType;
$user->MineColor =  $UserMineColor;
$user->SubColor =  $UserSubColor;
$user->save();


$UserID = $user->id;

    //save img
       foreach ($request->session()->get('TransInputImage.image') as $img) {

           $form_data = array(
              'UserID'  => $UserID,
              'ImgType'  => 'Transparent',
              'TheImg' => $img
          );
           Img::create($form_data);

       }

       foreach ($request->session()->get('WithBackInputImage.image') as $img) {
           $form_data = array(
              'UserID'  => $UserID,
              'ImgType'  => 'WithBackGound',
              'TheImg' => $img
          );
           Img::create($form_data);

       }


       //save design
       foreach (session()->get('allImgPath.path') as $key => $img) {
           $image_file = './img/output/' . $img . '.png';
           $image = Image::make($image_file);
           Response::make($image->encode('png'));
           $form_data = array(
              'UserID'  => $UserID,
              'TheImg' => $image
          );
           UserDesign::create($form_data);
       }


       //Delete all imgs
      foreach (session()->get('allImgPath.path') as $key => $img) {
        $image_file = './img/output/' . $img . '.png';
          if(is_file($image_file))
            unlink($image_file); // delete file

      }

       Auth::loginUsingId($UserID, true);

       session()->forget('TransInputImage');
       session()->forget('WithBackInputImage');

        return Redirect::route('home', array('St' => 'N'));

    }


   public function submit(Request $request) {

     $form_data = array(
          'Nots'  => $request->Nots,
      );
         Nots::create($form_data);
   }


   public function PostcreateStep4 (Request $request) {
    $UserID = Auth::id();

    //delete old design
    DB::table('user_designs')
    ->where('UserID', $UserID)
    ->delete();

    //save New Design
   foreach (session()->get('allImgPath.path') as $key => $img) {
       $image_file = './img/output/' . $img . '.png';
       $image = Image::make($image_file);
       Response::make($image->encode('png'));
       $form_data = array(
          'UserID'  => $UserID,
          'TheImg' => $image
      );
       UserDesign::create($form_data);
   }

  return Redirect::route('home', array('St' => 'N'));
    dd($UserID);

   }





}
