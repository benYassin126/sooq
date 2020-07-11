<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Img;

class TryController extends Controller
{
    public function index() {
        return view('try.index');
    }

    public function createStep1(Request $request)
    {
        $try = $request->session()->get('try');
        return view('try.step1',compact('try'));
    }

    public function PostcreateStep1(Request $request)
    {
        $validatedData = $request->validate([
            'TheImg' => 'required',
        ]);
        if(empty($request->session()->get('imgs'))){
            $imgs = new \App\Img;
            $imgs->fill($validatedData);
            $request->session()->put('imgs', $imgs);
        }else{
            $imgs = $request->session()->get('imgs');
            $imgs->fill($validatedData);
            $request->session()->put('imgs', $imgs);
        }

        return redirect('/try/form2');
    }

    public function createStep2(Request $request)
    {
        $imgs = $request->session()->get('imgs');
        return view('try.step2',compact('imgs'));
    }

    public function PostcreateStep2(Request $request)
    {
        $validatedData = $request->validate([
            'UserID' => 'required',
        ]);
        if(empty($request->session()->get('imgs'))){
            $imgs = new \App\Img();
            $imgs->fill($validatedData);
            $request->session()->put('imgs', $imgs);
        }else{
            $imgs = $request->session()->get('imgs');
            $imgs->fill($validatedData);
            $request->session()->put('imgs', $imgs);
        }
        return redirect('/try/form3');
    }

   public function createStep3(Request $request)
    {
        $user = $request->session()->get('user');
        return view('try.step3',compact('user'));
    }

    public function PostcreateStep3(Request $request)
    {
        $user = $request->session()->get('user');


        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        if(empty($request->session()->get('user'))){
            $user = new \App\User();
            $user->fill($validatedData);
            $request->session()->put('user', $user);
        }else{
            $user = $request->session()->get('user');
            $user->fill($validatedData);
            $request->session()->put('user', $user);
        }

         $imgs = $request->session()->get('imgs');
        return view('try.step4',compact('user','imgs'));
    }

        public function store(Request $request)
    {
        $imgs = $request->session()->get('imgs');
        $user = $request->session()->get('user');

        $imgs->save();

        return redirect('/');
    }

}
