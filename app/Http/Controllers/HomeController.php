<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Auth;
use App\Img;
use Image;
use Session;
use App\UserDesign;
use App\User;
use Mail;
use ZipArchive;
use App\Mail\images;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('fetch_image');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $UserID = Auth::id();

        $allImgTrans = Img::Select('id')->where([['imgType','Transparent'],['UserID',$UserID]])->first();
        $allImgBack = Img::Select('id')->where([['imgType','WithBackGound'],['UserID',$UserID]])->first();
        $allUserDesigns = UserDesign::Select('id')->where('UserID',$UserID)->get();


        //Check If user new

        if (isset($_GET['St']) && $_GET['St'] == 'N') {
          $user = User::all()->where('id',$UserID);
          Mail::to($user->first()->email)->send(new images($allUserDesigns));
          $newUser = '';
         return view('user.home',compact('newUser','allUserDesigns','allImgTrans','allImgBack'));
        }


        return view('user.home',compact('allUserDesigns','allImgTrans','allImgBack'));

    }

   function fetch_image($image_id)
   {
       $image = UserDesign::findOrFail($image_id);

       $image_file = Image::make($image->TheImg);

       $response = Response::make($image_file->encode('png'));

       $response->header('Content-Type', 'image/png');

       return $response;
   }

   function dwonloadAllImages(Request $request) {

    $UserID = Auth::id();
    $allUserDesigns = UserDesign::Select('id')->where('UserID',$UserID)->get();


$files = $allUserDesigns;


$tmpFile = tempnam('.', '');

$zip = new ZipArchive;
$zip->open($tmpFile, ZipArchive::CREATE);
foreach ($files as $file) {
  $imgUrl = "https://rwwj.website/home/fetch_image/". $file->id . ".png";

    $download_file = file_get_contents($imgUrl);

    #add it to the zip
    $zip->addFromString(basename($imgUrl), $download_file);
}
$zip->close();
header('Content-disposition: attachment; filename=file.zip');
header('Content-Type: application/zip');
readfile($tmpFile);
unlink($tmpFile);

   }

}
