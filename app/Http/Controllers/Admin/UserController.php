<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Image;
use Crypt;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        $allUsers = User::all();
        return view('admin.user.index',compact('allUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //  dd($request->BusinessType);
         $request->validate([
          'name'  => 'required',
          'email'  => 'required|unique:Users,email',
          'BusinessType'  => 'required',
          'Logo' => 'image|max:2000',
          'password' => 'required',
          'Balance' => 'numeric',
      ]);
         $form_data = array(
          'name'  => $request->name,
          'email'  => $request->email,
          'password' => Crypt::encrypt($request->password),
          'Balance' => $request->Balance,
          'Twitter' => $request->Twitter,
          'Instagram' => $request->Instagram,
          'Append' => $request->Append,
      );

         if ($request->OtherBusinessType == null) {
            $form_data['BusinessType'] = $request->BusinessType;
         }else {
            $form_data['BusinessType'] = $request->OtherBusinessType;
         }


         if ($request->MineColor != '#010101') {
              $form_data['MineColor'] = $request->MineColor;
          }

          if ($request->SubColor != '#010101') {
              $form_data['SubColor'] = $request->SubColor;
          }

         //Store Template background
         if ($request->has('Logo')) {
             $image_file = $request->Logo;
             $image = Image::make($image_file);
             Response::make($image->encode('png'));
             $form_data['Logo'] =  $image;
         }

        // dd($form_data);
         User::create($form_data);
         return redirect('admin/user')->with('success', 'تم اضافة العميل بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
         $thisUser = $user;
         $plinPassword = Crypt::decrypt($thisUser->password);
         return view('admin.user.updateTemplate',compact('thisUser','plinPassword'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

         $request->validate([
          'name'  => 'required',
          'email'  => 'required',
          'BusinessType'  => 'required',
          'Logo' => 'image|max:2000',
          'Balance' => 'numeric',
      ]);
         $form_data = array(
          'name'  => $request->name,
          'email'  => $request->email,
          'password' => Crypt::encrypt($request->password),
          'Balance' => $request->Balance,
          'Twitter' => $request->Twitter,
          'Instagram' => $request->Instagram,
          'Append' => $request->Append,
      );

         if ($request->OtherBusinessType == null) {
            $form_data['BusinessType'] = $request->BusinessType;
         }else {
            $form_data['BusinessType'] = $request->OtherBusinessType;
         }


         //update color only when user change it
         if ($request->MineColor != '#010101') {
              $form_data['MineColor'] = $request->MineColor;
          }

          if ($request->SubColor != '#010101') {
              $form_data['SubColor'] = $request->SubColor;
          }

         if ($request->has('Logo')) {
             $image_file = $request->Logo;
             $image = Image::make($image_file);
             Response::make($image->encode('png'));
             $form_data['Logo'] =  $image;
         }

         $user->update($form_data);
         return redirect('admin/user')->with('success', 'تم  التعديل العميل بنجاح');

    }


    //Function to serch user

    public function search(Request $request)
    {

        $allUsers = User::orderByDesc('id')->where([
            ['name','LIKE','%'.$request->search."%"],
        ])->get();

        if($request->ajax())
        {
            $output="";
            $allUsers;
            if($allUsers)
            {
                foreach ($allUsers as $key => $user) {
                  (isset($user->Subscrip)) ? $Subscrip = $user->Subscrip->PakageName : $Subscrip ='لم يشترك' ;
                  ($user->Append == 0) ? $Append = 'مفعل' : $Append = 'محظور';
                    $output.='<tr>'.
                    '<td>'.$key.'</td>'.
                    '<td>'.$user->name.'</td>'.
                    '<td>'.  $Subscrip . '</td>'.
                    '<td> - </td>'.
                    '<td>'.$Append.'</td>'.
                    '<td>
                    <a href="user/' . $user->id .'/edit" class="btn btn-info "><i class="fas fa-edit"></i> تعديل </a>'.
                    '</tr>';
                }
                return Response($output);
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
            $user->delete();
            return redirect('admin/user')->with('message', 'تم حذف   العميل ' . $user->name . ' بنجاح ');
    }
}
