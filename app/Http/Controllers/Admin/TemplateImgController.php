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
      'TheImg.*' => 'required|image|max:300',

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
        //We are Here Just Test The code for copy imge when user input tranport image
        //will we use this function to edit every image in template like .. transport or not

        //Start Handle TestImg
       $imgTest = './img/testImg/testImg.png';
       $imgTest = imagecreatefromstring(file_get_contents($imgTest));
         //End First Handle TestImg

        //Start BackGround
       $backgroundImg = Image::make($templateImg->TheImg);
       $backgroundImg = imagecreatefromstring($templateImg->TheImg);
        //Finsh BackGround

       //start try to change color
        $index = imagecolorclosest ( $backgroundImg,  110,21,15 ); // get White COlor
        imagecolorset($backgroundImg,$index,92,92,92); // SET NEW COLOR
       //end try to change color

        //Start Copy Tow Images
       imagecopyresampled($backgroundImg, $imgTest, 40, 80, 0, 0, 485, 410, imagesx($imgTest), imagesy($imgTest));
       imagepng($backgroundImg, "./img/output/output.png", 9);
        //Finsh Copy Tow Images

       //Send image data to show when edit then update it
       $thisImg = $templateImg;
       return view('admin.TemplateImg.updateTemplateImg',compact('thisImg'));
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



    public function xyz(TemplateImg $templateImg,Request $request) {
/*

        if($request->ajax()) {


            //delete all files
            $folder_path =  "./img/output";
            $files = glob($folder_path.'/*');

            foreach($files as $file) {

                if(is_file($file))
                    unlink($file);
            }

            //new Neme To Fresh Output
            $newName =  'output_' . rand(0 , 10000) . "__";

            $dst_x = $request->dst_x;
            $dst_y = $request->dst_y;
           // $dst_w = $request->dst_w;
          //  $dst_h = $request->dst_h;

            $backgroundImg = Image::make($templateImg->TheImg);//get background from db and convert it to img
            $backgroundImg = imagecreatefromstring($templateImg->TheImg);//convert background to gd recuse
            $imgTest = './img/testImg4.png';//get Test Imge
            list($width,$height) = getimagesize($imgTest);//get Test Imge Heght and width
            $new_width = 500;


            $imgTest = imagecreatefromstring(file_get_contents($imgTest));//convert img test to gd resuce
            $img_height = imagesy($imgTest);

        switch ($img_height) {
            case $img_height > 400 && $img_height < 500 :
                 $new_height = 450;
                 $dst_y = 50;
                break;
                case $img_height > 300 && $img_height < 400:
                $new_height = 350;
                $dst_y = 100;
                break;
                case $img_height > 200 && $img_height < 300 :
                $new_height = 250;
                $dst_y = 150;
                break;
            default:
                $new_height = 500;
                break;
        }


           // imagecopyresampled($backgroundImg, $imgTest, $dst_x,  $dst_y, 0, 0,$dst_w,$dst_h, $width, $height);//copy imgeTest to BackGround
            imagecopyresampled($backgroundImg, $imgTest, $dst_x, $dst_y, 0, 0, $new_width, $new_height, $width, $height);
            imagepng($backgroundImg, "./img/output/" . $newName . ".png", 9);//store output in img
            $output = "<img class='img-responsive' src='/img/output/" .  $newName .  ".png'>";
            return Response($output);


            imagedestroy($im); // TTTTTTRRRRRRRRRRRRYYYYYYY




        }
        */

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
