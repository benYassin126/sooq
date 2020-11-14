<?php

namespace App\Http\Controllers;
use App\Img;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use Image;
use DB;


class UserImgsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('fetch_image');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UserID = Auth::id();
        $allImg = Img::all()->where('UserID',$UserID);
        return view('user.userImgs.index',compact('allImg'));
    }


   function fetch_image($image_id)
   {
       $image = Img::findOrFail($image_id);

       $image_file = Image::make($image->TheImg);

       $response = Response::make($image_file->encode('png'));

       $response->header('Content-Type', 'image/png');

       return $response;
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.userImgs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $UserID = Auth::id();
       $request->validate([
          'Transparent.*' => 'image|max:10240',//10MB
          'WithBackGound.*' => 'image|max:10240',//10MB

      ]);


       if ($request->has('Transparent')) {
           foreach ($request->Transparent as $img) {
             $destinationPath = public_path('./img/storage/imgs');
             $name =  rand(0,5000000) . '.png';
             $image_file = $img;
             $image = Image::make($image_file);
             Response::make($image->encode('png'));
            $image = imagecreatefromstring($image);
            imagealphablending($image, false);
            imagesavealpha($image, true);
             imagepng($image,$destinationPath.'/'.$name,9);
               $form_data = array(
                  'UserID'  => $UserID,
                  'ImgType'  => 'Transparent',
                  'TheImg' => $name
              );
               Img::create($form_data);

           }
       }

       if ($request->has('WithBackGound')) {
           foreach ($request->WithBackGound as $img) {
             $destinationPath = public_path('./img/storage/imgs');
             $name =  rand(0,5000000) . '.png';
             $image_file = $img;
             $image = Image::make($image_file);
             Response::make($image->encode('png'));
            $image = imagecreatefromstring($image);
             imagepng($image,$destinationPath.'/'.$name,9);
                   $form_data = array(
                      'UserID'  => $UserID,
                      'ImgType'  => 'WithBackGound',
                      'TheImg' => $name
                  );
               Img::create($form_data);

           }
       }

        return redirect('/imgs')->with('success','تم اضافة الصور بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Img  $img
     * @return \Illuminate\Http\Response
     */
    public function show(Img $img)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Img  $img
     * @return \Illuminate\Http\Response
     */
    public function edit(Img $img)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Img  $img
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Img $img)
    {
      $request->validate([
           'ImgType' => 'required'
       ]);


      if ($request->ShowName == 'on') {
         $request->ShowName = 'yes';
      }else {
        $request->ShowName = 'no';
      }

      $form_data = array(
      'ImgName' => $request->ImgName,
      'ShowName' => $request->ShowName,
      'ImgSection' => $request->ImgSection,
      'ImgType' => $request->ImgType,
      'ImgPrice' => $request->ImgPrice,
      'ImgSPrice' => $request->ImgSPrice,
      'ImgMPrice' => $request->ImgMPrice,
      'ImgLPrice' => $request->ImgLPrice,
      );


        $img->update($form_data);
        return redirect('/imgs')->with('success', 'تم تحديث بيانات المنتج');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Img  $img
     * @return \Illuminate\Http\Response
     */
    public function destroy(Img $img)
    {
            $img->delete();
            return redirect('imgs')->with('success', 'تم حذف الصورة بنجاح');
    }

    public function deleteAllImgs() {
        $UserID = Auth::id();
     //delete old design
    DB::table('imgs')
    ->where('UserID', $UserID)
    ->delete();
    return redirect('/imgs')->with('success', 'تم حذف جميع الصور');


    }
}
