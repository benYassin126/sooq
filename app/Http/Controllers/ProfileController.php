<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Redirect;
use DB;
use Crypt;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $UserID = Auth::id();
        $user = User::all()->where('id',$UserID)->first();
        return view('user.profile.index',compact('user'));
    }

    public function edit (Request $request) {
        $UserID = Auth::id();
        $user = User::find($UserID);

         $request->validate([
          'name'  => 'required',
          'email'  => 'required',
      ]);
         $form_data = array(
          'name'  => $request->name,
          'email'  => $request->email,
          'Twitter' => $request->Twitter,
          'Instagram' => $request->Instagram,
      );



         if ($request->MineColor != '') {
          $form_data['password'] =  Crypt::encrypt($request->password);
         }
         //update color only when user change it
         if ($request->MineColor != '#010101') {
              $form_data['MineColor'] = $request->MineColor;
          }

          if ($request->SubColor != '#010101') {
              $form_data['SubColor'] = $request->SubColor;
          }


         $user->update($form_data);
         return redirect('/profile')->with('success', 'تم تحديث ملفك الشخصي بنجاح');
    }
}
