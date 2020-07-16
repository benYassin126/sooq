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
use App\Mail\test1;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $UserID = Auth::id();
        $allImg = Img::all()->where('UserID',$UserID);
        $allUserDesigns = UserDesign::all()->where('UserID',$UserID);

        //Check If user new

        if (isset($_GET['St']) && $_GET['St'] == 'N') {

          $user = User::all()->where('id',$UserID);
          Mail::to($user->first()->email)->send(new test1($allUserDesigns));
          $newUser = '';
         return view('user.home',compact('allImg','allUserDesigns','newUser'));
        }


        return view('user.home',compact('allImg','allUserDesigns'));
    }

   function fetch_image($image_id)
   {
       $image = UserDesign::findOrFail($image_id);

       $image_file = Image::make($image->TheImg);

       $response = Response::make($image_file->encode('png'));

       $response->header('Content-Type', 'image/png');

       return $response;
   }
}
