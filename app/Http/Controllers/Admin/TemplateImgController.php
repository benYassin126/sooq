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
        //
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
          'TheImg.*' => 'required|image|max:300'
      ]);

       foreach ($request->TheImg as $img) {
           $image_file = $img;
           $image = Image::make($image_file);
           Response::make($image->encode('jpeg'));
           $form_data = array(
              'TemplateID'  => $request->TemplateID,
              'TheImg' => $image
          );
           TemplateImg::create($form_data);

       }

       $Templatepath = 'admin/template/' . $request->TemplateID;
       return redirect($Templatepath)->with('success', 'تم رفع التصاميم للقالب بنجاح');
   }


   function fetch_image($image_id)
   {
       $image = TemplateImg::findOrFail($image_id);

       $image_file = Image::make($image->TheImg);

       $response = Response::make($image_file->encode('jpeg'));

       $response->header('Content-Type', 'image/jpeg');

       return $response;
   }

    /**
     * Display the specified resource.
     *
     * @param  \App\TemplateImg  $templateImg
     * @return \Illuminate\Http\Response
     */
    public function show(TemplateImg $templateImg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TemplateImg  $templateImg
     * @return \Illuminate\Http\Response
     */
    public function edit(TemplateImg $templateImg)
    {
        $dst_x = $templateImg->dst_x;
        $dst_y = $templateImg->dst_y;
        $dst_w = $templateImg->dst_w;
        $dst_h = $templateImg->dst_h;

        $backgroundImg = Image::make($templateImg->TheImg);//get background from db and convert it to img
        $backgroundImg = imagecreatefromstring($templateImg->TheImg);//convert background to gd recuse
        $imgTest = './img/testImg.png';//get Test Imge
        list($width,$height) = getimagesize($imgTest);//get Test Imge Heght and width
        $imgTest = imagecreatefromstring(file_get_contents($imgTest));//convert img test to gd resuce
        imagecopyresampled($backgroundImg, $imgTest, $dst_x,  $dst_y, 0, 0,$dst_w,$dst_h, $width, $height);//copy imgeTest to BackGround
        imagepng($backgroundImg, "./img/output/output.png", 9);//store output in img

        $thisImg = $templateImg;
        return view('admin.TemplateImg.updateTemplateImg',compact('templateImg','thisImg'));
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
           'dst_x' => 'required|numeric',
           'dst_y' => 'required|numeric',
           'dst_h' => 'required|numeric',
           'dst_w' => 'required|numeric',
       ]);


        $templateImg->update($request->all());

        return redirect()->back();

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
