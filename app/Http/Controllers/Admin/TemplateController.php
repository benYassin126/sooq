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
              'TemplateBackGround' => 'required|image|max:300',
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

                $TransparentinDesign = TemplateImg::select('TheImg')->where([['imgType','Transparent'],['TemplateID',$template->id]])->get();

                foreach ($TransparentinDesign as $index => $trns) {
                    $backImg = imagecreatefromstring($trns->TheImg);
                    if (imagesx($allTransImg[$index]) > 500 || imagesy($allTransImg[$index]) > 500) {
                        $new_widht = 450;
                        $new_height = 400;
                        $xoffset = (imagesx($backImg) - 450) / 2;
                        $yoffset = (imagesy($backImg)  -  400) / 2;
                    }else {
                        $new_widht =  imagesx($allTransImg[$index]);
                        $new_height =  imagesy($allTransImg[$index]);
                        $xoffset = (imagesx($backImg) - imagesx($allTransImg[$index])) / 2;
                        $yoffset = (imagesy($backImg)  -  imagesy($allTransImg[$index])) / 2;

                    }

                    imagecopyresampled($backImg, $allTransImg[$index],  $xoffset, $yoffset, 0, 0,$new_widht,$new_height, imagesx($allTransImg[$index]), imagesy($allTransImg[$index]));
                    imagepng($backImg, "./img/output/output" . $index .".png", 9);
                }

            }


            //Second Case : When user inert WithBackGound images
            if ($request->has('WithBackGound')) {
                $uploadedWithBackGround = count(collect($request)->get('WithBackGound'));
            }



             //Thierd Case : When user inert WithBackGound images without Transparent or reverse
            if (!$request->has('Transparent') && $request->has('WithBackGound')) {
                dd('Has Back No Has Trans');

            }elseif ($request->has('Transparent') && !$request->has('WithBackGound')) {

               dd('Has Trans No Has Back');
           }elseif (!$request->has('Transparent') && !$request->has('WithBackGound')) {

            return redirect()->back()->withErrors(['على الأقل أدخل صورة']);;
        }


        return view('admin.template.useTemplate',compact('template'));
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
              'MineColor' => $request->MineColor,
              'SubColor' => $request->SubColor,
              'SubSubColor' => $request->SubSubColor,
          );

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
