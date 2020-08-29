<?php

namespace App\Http\Controllers\Admin;

use App\Template;
use App\TemplateImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Image;

class TemplateController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */



        public function index()
        {
            $allTemplates = Template::all();
            return view('admin.template.index',compact('allTemplates'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
         return view('admin.template.createTemplate');
     }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {

         $request->validate([
          'TemplateName'  => 'required',
          'TemplateBackGround' => 'required|image|max:50120',
          'MineColor' => 'required'
      ]);

         //Store Template background

         $image_file = $request->TemplateBackGround;
         $image = Image::make($image_file);
         Response::make($image->encode('jpeg'));
         $form_data = array(
          'TemplateName'  => $request->TemplateName,
          'TemplateBackGround' => $image,
          'MineColor' => $request->MineColor,
          'SubColor' => $request->SubColor,
          'SubSubColor' => $request->SubSubColor,
      );
         Template::create($form_data);
         return redirect('admin/template')->with('success', 'تم رفع القالب بنجاح');
     }



        /**
         * Display the specified resource.
         *
         * @param  \App\Template  $template
         * @return \Illuminate\Http\Response
         */
        public function show(Template $template)
        {
            $allImg = TemplateImg::all()->where('TemplateID',$template->id);
            $thisTemplate = $template;
            return view('admin.template.showTemplate',compact('allImg','thisTemplate'));
        }


        //show use template form

        public function useTemplateShow(Template $template ,Request $request) {

            $countOFTransparent = TemplateImg::select('id')->where([['imgType','Transparent'],['TemplateID',$template->id]])->count();
            $countOFWithBackGound = TemplateImg::select('id')->where([['imgType','WithBackGound'],['TemplateID',$template->id]])->count();
            return view('admin.template.useTemplate',compact('template','countOFTransparent','countOFWithBackGound'));

        }


        //display The Dedign after process

        public function useTemplateUpload(Template $template,Request $request) {

            $request->validate([
              'Transparent.*' => 'required|image|max:50120',
              'WithBackGound.*' => 'required|image|max:50120|required',

          ]);

            //define if user change color when insert data or not

            if ($request->MineColor != strtolower($template->MineColor) || $request->SubColor != strtolower($template->SubColor) || $request->SubSubColor != strtolower($template->SubSubColor)) {
                $changeColor = true;
            }else {
                $changeColor = false;
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



            // get all Template image ID
            $allTemplateImg = TemplateImg::select('id','imgType')->where('TemplateID',$template->id)->get();


            //if user change color >> change all template color then store it in another file
            //and return all template with new color

            if ($changeColor == true ){

             foreach ($allTemplateImg as $index => $img) {
                //get All image and Crate it as PNG
                $imgUrl = "http://$_SERVER[HTTP_HOST]/admin/templateImg/fetch_image/". $img->id;
                $backImg = imagecreatefrompng($imgUrl);

                //store RGB colors to change template color
                list($rMineTemplate, $gMimeTemplate, $bMineTemplate) = sscanf($template->MineColor, "#%02x%02x%02x");
                list($rMineUser, $gMineUser, $bMineUser) = sscanf($request->MineColor, "#%02x%02x%02x");
                list($rSubTemplate, $gSubTemplate, $bSubTemplate) = sscanf($template->SubColor, "#%02x%02x%02x");
                list($rSubUser, $gSubUser, $bSubUser) = sscanf($request->SubColor, "#%02x%02x%02x");
                list($rSubSubTemplate, $gSubSubTemplate, $bSubSubTemplate) = sscanf($template->SubSubColor, "#%02x%02x%02x");


                //make the imgae as platte mode to allow us change template color
                imagetruecolortopalette($backImg,false, 255);
                $indexx = imagecolorclosest($backImg,$rMineTemplate, $gMimeTemplate, $bMineTemplate);
                imagecolorset($backImg,$indexx,$rMineUser,$gMineUser,$bMineUser); // SET NEW COLOR
                $indexx = imagecolorclosest($backImg,$rSubTemplate, $gSubTemplate, $bSubTemplate);
                imagecolorset($backImg,$indexx,$rSubUser,$gSubUser,$bSubUser); // SET NEW COLOR
                $indexx = imagecolorclosest($backImg,$rSubSubTemplate, $gSubSubTemplate, $bSubSubTemplate);
                imagecolorset($backImg,$indexx,$rMineUser,$gMineUser,$bMineTemplate); // SET NEW COLOR

                //difrent file foreache type
                $imgName = "Template" . $img->id;
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


        //First Case : When user inert Transparent images
        if ($request->has('Transparent')) {
            $uploadedTranparent = count(collect($request)->get('Transparent'));
            $countOFTransparent = TemplateImg::select('id')->where([['imgType','Transparent'],['TemplateID',$template->id]])->count();
            $allTransImg = array();
            $imges = $request->file('Transparent');
            foreach ($imges as $img) {
                $img = Image::make($img);
                Response::make($img->encode('png'));
                $img = imagecreatefromstring($img);
                array_push($allTransImg,$img);
            }

            //if user insert images less than transpernt template repetiton images
            if ($uploadedTranparent < $countOFTransparent) {

                for ($i=0; $i < $countOFTransparent - $uploadedTranparent ; $i++) {
                    array_push($allTransImg,$allTransImg[$i]);
                }

            }

            $TransparentinDesign = TemplateImg::select('TheImg','id')->where([['imgType','Transparent'],['TemplateID',$template->id]])->get();

            foreach ($TransparentinDesign as $index => $trns) {

                //get template thrgoh two way
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
                    $new_height = imagesy($backImg) - $decRate;
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

                $imgName = "Template" . $trns->id;
                imagepng($backImg, "./img/output/" . $imgName .".png", 9);
                array_push($allImgPath,$imgName);


            }

        }


            //Second Case : When user inert WithBackGound images
        if ($request->has('WithBackGound')) {
            $uploadedWithBackGround = count(collect($request)->get('WithBackGound'));
            $countOFWithBackGround = TemplateImg::select('id')->where([['imgType','WithBackGound'],['TemplateID',$template->id]])->count();
            $allWithBack = array();

            $imges = $request->file('WithBackGound');
            foreach ($imges as $img) {
                $img = imagecreatefromstring(file_get_contents($img));
                array_push($allWithBack,$img);

            }
            if ($uploadedWithBackGround < $countOFWithBackGround) {

                for ($i=0; $i < $countOFWithBackGround - $uploadedWithBackGround ; $i++) {
                    array_push($allWithBack,$allWithBack[$i]);
                }

            }

            $WithBackinDesign = TemplateImg::select('id')->where([['imgType','WithBackGound'],['TemplateID',$template->id]])->get();


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
                imagepng($thumb, "./img/output/" . $imgName .".png", 9);

                }else {
                $allWithBack[$index] = imagescale($allWithBack[$index] ,imagesx($backImg) ,imagesx($backImg));
                imagecopymerge_alpha($allWithBack[$index], $backImg, 0, 0, 0, 0,imagesx($allWithBack[$index]),imagesy($allWithBack[$index]), imagesx($backImg), imagesy($backImg));
                $imgName = $wtihBack->id;
                imagepng($allWithBack[$index], "./img/output/" . $imgName .".png", 9);

                }
                array_push($allImgPath,$imgName);
            }

        }

        //sort output images to show it Nice
        sort($allImgPath);
        return view('admin.template.useTemplate',compact('template','allImgPath'));
    }

    //function to show temblate background
    function fetch_image($image_id)
    {
     $image = Template::findOrFail($image_id);

     $image_file = Image::make($image->TemplateBackGround);

     $response = Response::make($image_file->encode('jpeg'));

     $response->header('Content-Type', 'image/jpeg');

     return $response;
 }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Template  $template
         * @return \Illuminate\Http\Response
         */
        public function edit(Template $template)
        {
         $thisTemplate = $template;
         return view('admin.template.updateTemplate',compact('thisTemplate'));
     }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Template  $template
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Template $template)
        {

            $form_data = array(
              'TemplateName' => $request->TemplateName,
          );

            //update color only when user change it

            if ($request->MineColor != '#010101') {
              $form_data['MineColor'] = $request->MineColor;
          }

          if ($request->SubColor != '#010101') {
              $form_data['SubColor'] = $request->SubColor;
          }

          if ($request->SubSubColor != '#010101') {
              $form_data['SubSubColor'] = $request->SubSubColor;
          }

          //if user change image
          if ($request->has('TemplateBackGround')) {
             $image_file = $request->TemplateBackGround;
             $image = Image::make($image_file);
             Response::make($image->encode('jpeg'));
             $form_data['TemplateBackGround'] = $image;
         }

         $template->update($form_data);
         return redirect('admin/template')->with('success', 'تم تعديل بيانات القالب بنجاح');
     }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Template  $template
         * @return \Illuminate\Http\Response
         */
        public function destroy(Template $template)
        {
            $template->delete();
            return redirect('admin/template')->with('message', 'تم حذف   القالب ' . $template->TemplateName . ' بنجاح ');
        }
    }
