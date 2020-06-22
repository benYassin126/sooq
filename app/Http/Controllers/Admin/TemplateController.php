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
          'TemplateBackGround' => 'required|image|max:300'
         ]);


             $image_file = $request->TemplateBackGround;
             $image = Image::make($image_file);
             Response::make($image->encode('jpeg'));
             $form_data = array(
              'TemplateName'  => $request->TemplateName,
              'TemplateBackGround' => $image
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
              'TemplateName' => $request->TemplateName
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
