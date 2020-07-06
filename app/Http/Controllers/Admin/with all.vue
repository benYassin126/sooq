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
              'TemplateBackGround' => 'required|image|max:2000',
              'MineColor' => 'required'
          ]);




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


        public function useTemplateShow(Template $template ,Request $request) {

            $countOFTransparent = TemplateImg::select('id')->where([['imgType','Transparent'],['TemplateID',$template->id]])->count();
            $countOFWithBackGound = TemplateImg::select('id')->where([['imgType','WithBackGound'],['TemplateID',$template->id]])->count();
            return view('admin.template.useTemplate',compact('template','countOFTransparent','countOFWithBackGound'));

        }



        public function useTemplateUpload(Template $template,Request $request) {




            $request->validate([
              'Transparent.*' => 'image|max:50120|required',
              'WithBackGound.*' => 'image|max:50120|required',

          ]);

            if ($request->MineColor != strtolower($template->MineColor) || $request->SubColor != strtolower($template->SubColor) || $request->SubSubColor != strtolower($template->SubSubColor)) {
                $changeColor = true;
            }else {
                $changeColor = false;
            }

            $allImgPath = array();


            function imagecopymerge_alpha($dst_image ,$src_image ,$dst_x ,$dst_y ,$src_x ,$src_y ,$dst_w ,$dst_h ,$src_w ,$src_h ) {
                    // creating a cut resource
                $cut = imagecreatetruecolor($src_w, $src_h);

                    // copying relevant section from background to the cut resource
                imagecopy($cut, $dst_image, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

                    // copying relevant section from watermark to the cut resource
                imagecopy($cut, $src_image, 0, 0, $src_x, $src_y, $src_w, $src_h);

                    // insert cut resource to destination image
                //imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
                imagecopyresampled($dst_image, $cut, $dst_x, $dst_y,$src_x, $src_y, $dst_w, $dst_h,$src_w,$src_h);
            }



            //if user change color >> change all template color then store it in another file
            //and return all template with new color

            $allTemplateImg = TemplateImg::select('TheImg','id','imgType')->where('TemplateID',$template->id)->get();

            if ($changeColor == true ){

               foreach ($allTemplateImg as $index => $img) {

                $imgUrl = "http://$_SERVER[HTTP_HOST]/admin/templateImg/fetch_image/". $img->id;
                $backImg = imagecreatefrompng($imgUrl);

                list($rMineTemplate, $gMimeTemplate, $bMineTemplate) = sscanf($template->MineColor, "#%02x%02x%02x");
                list($rMineUser, $gMineUser, $bMineUser) = sscanf($request->MineColor, "#%02x%02x%02x");
                list($rSubTemplate, $gSubTemplate, $bSubTemplate) = sscanf($template->SubColor, "#%02x%02x%02x");
                list($rSubUser, $gSubUser, $bSubUser) = sscanf($request->SubColor, "#%02x%02x%02x");
                list($rSubSubTemplate, $gSubSubTemplate, $bSubSubTemplate) = sscanf($template->SubSubColor, "#%02x%02x%02x");
                list($rSubSubUser, $gSubSubUser, $bSubSubUser) = sscanf($request->SubSubColor, "#%02x%02x%02x");
             imagetruecolortopalette($backImg,true, 255);




                $indexx = imagecolorclosest($backImg,$rMineTemplate, $gMimeTemplate, $bMineTemplate);
                imagecolorset($backImg,$indexx,$rMineUser,$gMineUser,$bMineUser); // SET NEW COLOR
                $indexx = imagecolorclosest($backImg,$rSubTemplate, $gSubTemplate, $bSubTemplate);
                imagecolorset($backImg,$indexx,$rSubUser,$gSubUser,$bSubUser); // SET NEW COLOR
                $indexx = imagecolorclosest($backImg,$rSubSubTemplate, $gSubSubTemplate, $bSubSubTemplate);
                imagecolorset($backImg,$indexx,$rSubSubUser,$gSubSubUser,$bSubSubUser); // SET NEW COLOR


                $imgName = "Template" . $img->id;
                if ($img->imgType == 'Transparent') {

                    imagepalettetotruecolor($backImg);
                    imagepng($backImg, "./img/newTemplateTrans/" . $imgName .".png", 9);
                }else {
                    $whiteindex=imagecolorclosest($backImg,255,255,255);
                    imagecolorset($backImg,$whiteindex,255,255,255,127);
                    imagealphablending($backImg, true);
                    imagesavealpha($backImg, true);
                    imagepng($backImg, "./img/newTemplateBack/" . $imgName .".png", 9);
                }


            }


        }
          //  dd('test Trans');

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

            if ($uploadedTranparent < $countOFTransparent) {

                for ($i=0; $i < $countOFTransparent - $uploadedTranparent ; $i++) {
                    array_push($allTransImg,$allTransImg[$i]);
                }

            }

            $TransparentinDesign = TemplateImg::select('TheImg','id')->where([['imgType','Transparent'],['TemplateID',$template->id]])->get();

            foreach ($TransparentinDesign as $index => $trns) {

                if ($changeColor == true) {
                    $backImg = imagecreatefrompng('./img/newTemplateTrans/Template' . $trns->id . '.png');

                }else {
                    $backImg = imagecreatefromstring($trns->TheImg);
                }



                if (imagesx($allTransImg[$index]) <= imagesx($backImg) && imagesy($allTransImg[$index]) <= imagesy($backImg)) {

                    $decRate = (imagesx($backImg) * 15) / 100;
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

                $allWithBack[$index] = imagescale($allWithBack[$index] ,imagesx($backImg) ,imagesx($backImg));
                imagecopymerge_alpha($allWithBack[$index], $backImg, 0, 0, 0, 0,imagesx($allWithBack[$index]),imagesy($allWithBack[$index]), imagesx($backImg), imagesy($backImg));

                $imgName = "Template" . $wtihBack->id;
                imagepng($allWithBack[$index], "./img/output/" . $imgName .".png", 9);
                array_push($allImgPath,$imgName);
            }

        }


        sort($allImgPath);


        return view('admin.template.useTemplate',compact('template','allImgPath'));
    }


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

            if ($request->MineColor != '#010101') {
              $form_data['MineColor'] = $request->MineColor;
          }

          if ($request->SubColor != '#010101') {
              $form_data['SubColor'] = $request->SubColor;
          }

          if ($request->SubSubColor != '#010101') {
              $form_data['SubSubColor'] = $request->SubSubColor;
          }

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
