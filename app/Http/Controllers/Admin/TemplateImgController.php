<?php


namespace App\Http\Controllers\Admin;
use App\TemplateImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Template;
use Image;

class TemplateImgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //show all templte images
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.TemplateImg.createTemplateImg');
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
          'TheImg.*' => 'required|image|max:2000',

      ]);

       foreach ($request->TheImg as $img) {
        $name =  rand(0,50000).'.'.$img->getClientOriginalExtension();
        $destinationPath = public_path('./img/storage/template_imgs');
        $img->move($destinationPath, $name);
           $form_data = array(
              'TemplateID'  => $request->TemplateID,
              'TheImg' => $name
          );
           TemplateImg::create($form_data);

       }

       $Templatepath = 'admin/template/' . $request->TemplateID;
       return redirect($Templatepath)->with('success', 'تم رفع التصاميم للقالب بنجاح');
   }



    /**
     * Display the specified resource.
     *
     * @param  \App\TemplateImg  $templateImg
     * @return \Illuminate\Http\Response
     */
    public function show(TemplateImg $templateImg)
    {
        //if will need to show all image as separately
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TemplateImg  $templateImg
     * @return \Illuminate\Http\Response
     */
    public function edit(TemplateImg $templateImg)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TemplateImg  $templateImg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TemplateImg $templateImg)
    {
        $request->validate([
           'ImgType' => 'required'
       ]);
        $templateImg->update($request->all());
        $Templatepath = 'admin/template/' . $templateImg->TemplateID;
        return redirect( $Templatepath )->with('success', 'تم تغيير نوع الصورة بنجاح');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TemplateImg  $templateImg
     * @return \Illuminate\Http\Response
     */
    public function destroy(TemplateImg $templateImg)
    {

        $templateImg->delete();
        $Templatepath = 'admin/template/' . $templateImg->TemplateID;
        return redirect( $Templatepath )->with('success', 'تم حذف الصورة بنجاح');
    }
}
