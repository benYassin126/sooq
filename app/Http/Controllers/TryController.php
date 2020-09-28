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

       $messages = [
            "Transparent.max" => "عدد الصور اكثر من 6 صور",
            "WithBackGound.max" => "عدد الصور أكثر من 6 صور"
         ];
        $validatedData = $this->validate($request, [
          'Transparent.*' => 'required|image|max:10240',
          'Transparent' => 'max:6',
          'WithBackGound.*' => 'image|max:10240',
          'WithBackGound' => 'max:6',

       ],$messages);

        Session::forget('TransInputImage');
        Session::forget('WithBackInputImage');
        Session::forget('CountOfTry');
        session()->put('TransInputImage.image', []);
        session()->put('WithBackInputImage.image', []);

        //chose two random template
        $allTemplates = Template::select('id')->get();
        if ($request->WithBackGound == null) {
            $allTemplates = Template::select('id')->where('TemplateType','Transparent')->get();
        }
        $allTemplatesID = array();
        foreach ($allTemplates as $Template) {
            array_push($allTemplatesID, $Template->id);
        }


        shuffle($allTemplatesID);
        session()->put('FirstTemplate',$allTemplatesID[0]);
        session()->put('SecondTemplate',$allTemplatesID[1]);
        session()->put('ThirdTemplate',$allTemplatesID[2]);
        session()->put('CurentTemplate',session()->get('FirstTemplate'));


        // A/B Testing
        $TestingArray = ['A','B'];
        $randomKay = array_rand($TestingArray,1);
        session()->put('Testing',$TestingArray[$randomKay]);



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
    $allTemplates = Template::all();
    $FirstTemplateID = $allTemplates->first()->id;
    return view('try.step2',compact('allTemplates','FirstTemplateID'));
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
        $user = User::select('MineColor','SubColor','CurentTemplate')->where('id',$UserID)->first();
        //chose two random template
        $allTemplates = Template::select('id')->get();
        $allTemplatesID = array();
        foreach ($allTemplates as $Template) {
            array_push($allTemplatesID, $Template->id);
        }


        shuffle($allTemplatesID);
        session()->put('FirstTemplate',$allTemplatesID[0]);
        session()->put('SecondTemplate',$allTemplatesID[1]);
        session()->put('ThirdTemplate',$allTemplatesID[2]);

        if ($user->CurentTemplate != null) {
            session()->put('CurentTemplate',$user->CurentTemplate);
        }else {
            session()->put('CurentTemplate',$allTemplatesID[0]);
        }





        //Start Set Mine and Sub Color to Sessions
        session()->put('MineColor',$user->MineColor );
        session()->put('SubColor',$user->SubColor );
        //End Set Mine and Sub Color to Sessions


        //Start Set Images

         $UserImgs = Img::Select('TheImg')->where([['ImgType','Transparent'],['UserID',$UserID]])->get();
         session()->put('TransInputImage.image', []);
         foreach ($UserImgs as $TransparentImg) {
               session()->push('TransInputImage.image', $TransparentImg->TheImg);
       }

         $UserImgs = Img::Select('TheImg')->where([['ImgType','WithBackGound'],['UserID',$UserID]])->get();
         session()->put('WithBackInputImage.image', []);
         foreach ($UserImgs as $WithBackGound) {
               session()->push('WithBackInputImage.image', $WithBackGound->TheImg);
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
/*

//START To Get All Enteractive Images

$BusinessType = session()->get('BusinessType');

// 1- Get Custom Enteractive
 $CustomEnteractive = Interactive::select('id','TheImg','Type')->where('Type',$BusinessType)->get();
// 2- Get Genral Enteractive
 $GenralEnteractive = Interactive::select('id','TheImg','Type')->where('Type','general')->get();
// 3- Get Friday Enteractive
 $FridayEnteractive = Interactive::select('id','TheImg','Type')->where('Type','Friday')->get();



//End To Get All Enteractive Images


*/




            // array to store all image path to call it in blade file
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
$allTemplateImg = TemplateImg::select('id','imgType')->where('TemplateID',$TemplateID)->get();

if ($changeColor == true ){

   foreach ($allTemplateImg as $index => $img) {

/*
switch ($index) {
  case '0':
    $backImg = imagecreatefromstring($CustomEnteractive[0]->TheImg);
    break;
  case '1':
    $backImg = imagecreatefromstring($FridayEnteractive[0]->TheImg);
    break;
  case '2':
    $backImg = imagecreatefromstring($FridayEnteractive[1]->TheImg);
    break;
  case '3':
    $backImg = imagecreatefromstring($FridayEnteractive[2]->TheImg);
    break;
  case '4':
    $backImg = imagecreatefromstring($GenralEnteractive[0]->TheImg);
    break;

  default:
    $imgUrl = "https://soouq.sa/admin/templateImg/fetch_image/". $img->id;
    $backImg = imagecreatefrompng($imgUrl);
    break;
}
*/

    //get All image and Crate it as PNG

    $imgUrl = "https://rwwj.website/admin/templateImg/fetch_image/". $img->id;
    $backImg = imagecreatefrompng($imgUrl);

    //store RGB colors to change template color
    list($rMineTemplate, $gMimeTemplate, $bMineTemplate) = sscanf($template->MineColor, "#%02x%02x%02x");
    list($rMineUser, $gMineUser, $bMineUser) = sscanf($UserMineColor, "#%02x%02x%02x");
    list($rSubTemplate, $gSubTemplate, $bSubTemplate) = sscanf($template->SubColor, "#%02x%02x%02x");
    list($rSubUser, $gSubUser, $bSubUser) = sscanf($UserSubColor, "#%02x%02x%02x");
    list($rSubSubTemplate, $gSubSubTemplate, $bSubSubTemplate) = sscanf($template->MineColor, "#%02x%02x%02x");


    //make the imgae as platte mode to allow us change template color
    imagetruecolortopalette($backImg,false, 255);
    $indexx = imagecolorclosest($backImg,$rMineTemplate, $gMimeTemplate, $bMineTemplate);
    imagecolorset($backImg,$indexx,$rMineUser,$gMineUser,$bMineUser); // SET NEW COLOR
    $indexx = imagecolorclosest($backImg,$rSubTemplate, $gSubTemplate, $bSubTemplate);
    imagecolorset($backImg,$indexx,$rSubUser,$gSubUser,$bSubUser); // SET NEW COLOR
    $indexx = imagecolorclosest($backImg,$rSubSubTemplate, $gSubSubTemplate, $bSubSubTemplate);
    imagecolorset($backImg,$indexx,$rMineUser,$gMineUser,$bMineUser); // SET NEW COLOR

    //difrent file foreache type
$imgName = "Template" . $img->id; imagepng($backImg, "./img/newTemplateTrans/" . $index .".png", 9);

    if ($img->imgType == 'Transparent') {
        imagepalettetotruecolor($backImg);
        imagepng($backImg, "./img/newTemplateTrans/" . $imgName .".png", 9);

    }elseif($img->imgType == 'WithBackGound') {
        imagecolortransparent($backImg,imagecolorat($backImg,500,500));
        imagealphablending($backImg, true);
        imagesavealpha($backImg, true);
        imagepng($backImg, "./img/newTemplateBack/" . $imgName .".png", 9);
    }


 }


}


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

        $TransparentinDesign = TemplateImg::select('TheImg','id')->where([['imgType','Transparent'],['TemplateID',$TemplateID]])->get();


        //start copy
        foreach ($TransparentinDesign as $index => $trns) {
            if ($changeColor == true) {
                $backImg = imagecreatefrompng('./img/newTemplateTrans/Template' . $trns->id . '.png');

            }else {
                $backImg = imagecreatefromstring($trns->TheImg);
            }

               //set width and height to image and make it at center
            if (imagesx($allTransImg[$index]) <= imagesx($backImg) && imagesy($allTransImg[$index]) <= imagesy($backImg)) {
                //rate of descree from mine image if was it less than template size
                $decRate = (imagesx($backImg) * 5) / 100;
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
            $imgName = $trns->id;
            imagepng($backImg, '.' . $FolderPath . '/' . $imgName .".png", 9);
            array_push($allImgPath,$imgName);
            array_push($allImgPathTrans,$imgName);

        }






            //second case

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

        $WithBackinDesign = TemplateImg::select('TheImg','id')->where([['imgType','WithBackGound'],['TemplateID',$TemplateID]])->get();

            foreach ($WithBackinDesign as $index => $wtihBack) {
                if ($changeColor == true) {
                    $backImg = imagecreatefrompng('./img/newTemplateBack/Template' . $wtihBack->id . '.png');
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
                imagepng($thumb,'.' . $FolderPath  . '/' . $imgName .".png", 9);

                }else {
                $allWithBack[$index] = imagescale($allWithBack[$index] ,imagesx($backImg) ,imagesx($backImg));
                imagecopymerge_alpha($allWithBack[$index], $backImg, 0, 0, 0, 0,imagesx($allWithBack[$index]),imagesy($allWithBack[$index]), imagesx($backImg), imagesy($backImg));
                $imgName = $wtihBack->id;
                imagepng($allWithBack[$index], '.' . $FolderPath  . '/' . $imgName .".png", 9);


                }
                array_push($allImgPath,$imgName);
                array_push($allImgPathBack,$imgName);
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

            if (session::get('Testing') == 'B' || $uploadedWithBackGround == 0) {
              $allTemplates = Template::select('id')->where('TemplateType','Transparent')->get();
            }else {
               $allTemplates = Template::all();
            }
            $FirstTemplateID = $TemplateID;


        return view('try.step3',compact('allImgPath','UserMineColor','UserSubColor','FolderPath','allTemplates','FirstTemplateID'));
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
$user->password =  Hash::make(($request->password));
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






       $FolderPath = session()->get('FolderPath');



       //save design
       foreach (session()->get('allImgPath.path') as $key => $img) {
           $image_file = '.' . $FolderPath  . '/' . $img . '.png';
           $image = Image::make($image_file);
           Response::make($image->encode('png'));
           $form_data = array(
              'UserID'  => $UserID,
              'TheImg' => $image,
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
       $form_data = array(
          'UserID'  => $UserID,
          'TheImg' => $image,
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
       }
    //End IMG ID

  return Redirect::route('home', array('St' => 'N'));


   }





}
