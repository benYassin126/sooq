@extends('layouts.app')
@section('content')
<!-- Hero Area Start -->
<div id="hero-area" class="hero-area-bg">
    <div class="container">
        <div class="row showTemplate">
            <div class="col-md-12 col-sm-12 text-center welcomeText">
                @if ($errors->any())
                <div class="alert-dismissible  alert alert-danger" id="display-success">
                    <ul>
                        <h3>للأسف الايميل مسجل من قبل ..</h3>
                    </ul>
                </div>
                @endif
            </div>
            <div class="col-md-6 col-sm-12">
                <div class=" text-center">
                    <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                        <!-- Start Show Template -->
                        <form class="form-horizontal">
                            <select class="form-control mb-4" onchange='CheckPhoneType(this.value);'>
                                <option value="inst" selected>شكل التصميم في الانستقرام</option>
                                <option value="tweet">شكل التصميم في تويتر</option>
                            </select>
                        </form>
                        @if(isset($allImgPath))
                        <!-- inst -->
                        <div class="MocUp text-center" id='inst'>
                            <div class="marvel-device iphone-x">
                                <div class="notch">
                                    <div class="camera"></div>
                                    <div class="speaker"></div>
                                </div>
                                <div class="top-bar"></div>
                                <div class="sleep"></div>
                                <div class="bottom-bar"></div>
                                <div class="volume"></div>
                                <div class="overflow">
                                    <div class="shadow shadow--tr"></div>
                                    <div class="shadow shadow--tl"></div>
                                    <div class="shadow shadow--br"></div>
                                    <div class="shadow shadow--bl"></div>
                                </div>
                                <div class="inner-shadow"></div>
                                <div class="screen">
                                    <img style="width: 100%;height: 250px" src="/img/instMock.png">
                                    @foreach(session()->get('allImgPath.path') as $key => $img)
                                    <img class="imgesInMockUp" src="{{$FolderPath}}/{{$img}}.png">
                                    @endforeach
                                    @if (count(session()->get('allImgPath.path')) < 12 )
                                    @for($i = 0; $i < (12 - count(session()->get('allImgPath.path'))); $i++)
                                    <img class="imgesInMockUp" src="/img/show.png">
                                    @endfor
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- tweet -->
                        <div class="MocUp text-center" id='tweet' class="tweet" style='display:none;'>
                            <div class="marvel-device iphone-x">
                                <div class="notch">
                                    <div class="camera"></div>
                                    <div class="speaker"></div>
                                </div>
                                <div class="top-bar"></div>
                                <div class="sleep"></div>
                                <div class="bottom-bar"></div>
                                <div class="volume"></div>
                                <div class="overflow">
                                    <div class="shadow shadow--tr"></div>
                                    <div class="shadow shadow--tl"></div>
                                    <div class="shadow shadow--br"></div>
                                    <div class="shadow shadow--bl"></div>
                                </div>
                                <div class="inner-shadow"></div>
                                <div class="screen">
                                    <img class="tweetMock" src="/img/tweet.png">
                                    <img class="imgesInMockUp" style="width: 80%;margin-top: -461px" src="{{$FolderPath}}/{{$img}}.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Show Template -->
            <div class="col-md-6 col-sm-12 mt-4 mt-50">
                <div class="text-center allBut">
                    <!-- Save -->
                    @guest
                    <button class="btn main-btn-success main-btn-sm   ml-2 mb-4" data-toggle="modal" data-target="#exampleModal3"><i class="fas fa-check"></i> حفظ   </button>
                    @endauth
                    @if (!Auth::guest())
                    <form id="a3tmed" action="{{ url('/try/form4') }}"  class="ml-2" method="post" style="display: inline;">
                        @csrf
                        <input type="hidden" name="UserID" value="{{Auth::id()}}">
                        <button class="btn main-btn-success main-btn-sm mb-20"> حفظ    <i class="fas fa-check"></i></button>
                    </form>
                    @endif
                    <!-- Edit -->
                    <button class="btn main-btn main-btn-sm  ml-2 mb-4"  data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i> تعديل</button>
                    <!-- New Design -->
                    @if(session()->get('CountOfTry') >= 0 && session()->get('CountOfTry') < 2  && session()->get('Testing') == 'A')
                    <form id="changeTemplateForm" class="form-horizontal" action="{{ url('/try/form2') }}" method="post" style="display: inline;">
                        @csrf
                        <input type="hidden" name="changeTemplate">
                        <input type="hidden" name="anotherTemplate">
                        <input type="hidden" name="anotherTry" value="{{session()->get('CountOfTry')}}">
                        <button type="submit" class="btn main-btn main-btn-sm  ml-2 mb-4"><i class="nav-icon fas fa-magic"></i> تصميم جديد</button>
                    </form>
                    @endif
                    @if(session()->get('CountOfTry') >= 0 && session()->get('CountOfTry') < 2  && session()->get('Testing') == 'B' || !Auth::guest())
                    <button class="btn main-btn ml-2 mb-4 main-btn-sm "  data-toggle="modal" data-target="#exampleModal4">تصميم جديد  <i class="nav-icon fas fa-magic"></i> </button>
                    @endif
                    @if(session()->get('CountOfTry') >= 2 && Auth::guest())
                    <button class="btn main-btn ml-2 mb-4 main-btn-sm "  data-toggle="modal" data-target="#exampleModal2">تصميم جديد  <i class="nav-icon fas fa-magic"></i> </button>
                    @endif
                    <!-- Retern -->
                    @guest
                    @if ($_SERVER['HTTP_REFERER'] != 'https://www.soouq.sa/try/form2')
                    <a href="javascript:history.back(1)"  class="btn main-btn ml-2 mb-4 main-btn-sm " id="goBack"><i class="fas fa-undo"></i> التصميم السابق </a>
                    @endif
                    @endauth
                </div>
                <h6 style="color: #eb3656; margin-bottom:80px;">* لإضافة الأسعار والنصوص للتصاميم .. أحفظ  التصميم</h6>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ساعدني في الوصول لمحتوى رهيب</h5>
            </div>
            <div class="modal-body">
                <form id="tryForm" class="form-horizontal" action="{{ url('/try/form2') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @guest
                        <div class="form-group">
                            <label class="control-label ml-2">صور المنتجات ( بدون خلفية )</label><br>
                            <div>
                                <input type="file" name="Transparent[]"   multiple="multiple" accept="image/*"  />
                            </div>
                            @if($errors->has('Transparent.*'))
                            <p style="color: red;font-weight: bold;">تأكد من صيغ الملفات المدخلة وحجمها</p>
                            @endif
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label ml-2">صور المنتجات ( مع خلفية )</label>
                            <div>
                                <input type="file" name="WithBackGound[]"   multiple="multiple" accept="image/*"  />
                            </div>
                            @if($errors->has('WithBackGound.*'))
                            <p style="color: red;font-weight: bold;">تأكد من صيغ الملفات المدخلة وحجمها</p>
                            @endif
                        </div>
                        <hr>
                        @endauth
                        @if(session()->get('MineColor') != '#010101' || session()->get('SubColor') != '#010101')
                        <a class="btn btn-primary" onclick="replaceColor();">عكس الآلوان  </a>
                        @endif
                        <div class="form-group mt-4 mb-2 select-color">
                            <p id="Coloralert" class="mb-4 alert alert-danger" style="font-weight: bold;display: none;">زودنا بألوان هويتك لاهنت</p>
                            <h6 class="control-label ">اللون الأساسي</h6>
                            @if ($LogoColors != null)
                            {{-- <p class="ml-2" style="display: inline;">اختر من الهوية :</p> --}}
                            <label>
                                <input type="radio"  @if( session()->get('MineColor')  == $LogoColors[0] ) checked @endif  name="MineColor">
                                <span onclick="selectMineFun('{{$LogoColors[0]}}')" class="ColorGrups" style="background:{{$LogoColors[0]}}"></span>
                            </label>
                            <label>
                                <input type="radio"  @if( session()->get('MineColor')  == $LogoColors[1] ) checked @endif  name="MineColor">
                                <span onclick="selectMineFun('{{$LogoColors[1]}}')" class="ColorGrups" style="background:{{$LogoColors[1]}}"></span>
                            </label>
                            <label>
                                <input type="radio"  @if( session()->get('MineColor')  == $LogoColors[2] ) checked @endif  name="MineColor">
                                <span onclick="selectMineFun('{{$LogoColors[2]}}')" class="ColorGrups" style="background:{{$LogoColors[2]}}"></span>
                            </label>
                            @endif
                            <span class="MinePalateButton mr-2"> <i class="fas fa-fill-drip"></i> </span>
                            <br>
                            <div id="MineColorPalete" style="display: none;">
                                <span class="mt-2 ml-2"> لوحة الألوان</span>
                                <div style="display: inline;">
                                    <input type="color" id="PicMineColor" onchange="picMineFun()" value="{{ session()->get('MineColor') }}">
                                    <input id ="MineColor" type="text" name="MineColor" class="mr-2" style="width: 80px;" value="{{ session()->get('MineColor') }}"  maxlength="7" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4 mb-2 select-color">
                            <p id="Coloralert" class="mb-4 alert alert-danger" style="font-weight: bold;display: none;">زودنا بألوان هويتك لاهنت</p>
                            <h6 class="control-label ">اللون الثانوي</h6>
                            @if ($LogoColors != null)

                            <label>
                                <input @if( session()->get('SubColor')  == $LogoColors[0] ) checked @endif type="radio" name="SubColor">
                                <span onclick="selectSubFun('{{$LogoColors[0]}}')" class="ColorGrups" style="background:{{$LogoColors[0]}}"></span>
                            </label>
                            <label>
                                <input  @if( session()->get('SubColor')  == $LogoColors[1] ) checked @endif  type="radio" name="SubColor">
                                <span onclick="selectSubFun('{{$LogoColors[1]}}')" class="ColorGrups" style="background:{{$LogoColors[1]}}"></span>
                            </label>
                            <label>
                                <input @if( session()->get('SubColor')  == $LogoColors[2] ) checked @endif type="radio" name="SubColor">
                                <span onclick="selectSubFun('{{$LogoColors[2]}}')" class="ColorGrups" style="background:{{$LogoColors[2]}}"></span>
                            </label>
                            @endif
                            <span class="SubPalateButton mr-2"> <i class="fas fa-fill-drip"></i> </span>
                            <br>
                            <div id="SubColorPalete" style="display: none;">


                            <span class="mt-2 ml-2">لوحة الألوان</span>
                            <div  id="SubColorPalete" style="display: inline;">
                                <input type="color" id= "PicSubColor" onchange="picSubeFun()"  value="{{ session()->get('SubColor') }}">
                                <input type="text" id="SubColor"  value="{{ session()->get('SubColor') }}" name="SubColor" class="mr-2" style="width: 80px;"  maxlength="7" >
                            </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="div-center">
                        <button type="submit" class="btn btn-success">جرب الآن <i class="fa fa-eye mr-2"></i> </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">كيف تبغى التصميم ؟</h5>
            </div>
            <div class="modal-body">
                <form method='post' action="" onsubmit="return post();">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label ml-2">امر تدلل .. كيف تحب يكون تصميمك ؟</label><br>
                            <div>
                                <textarea class="form-control" id="msg" name="msg"></textarea>
                            </div>
                        </div>
                        <div class="div-center">
                            <button type="submit" id="submit" value="Submit"  class="btn btn-success">لاهنت</button>
                        </div>
                    </form>
                    <h5 class="mt-2" id="status"></h5>
                </div>
                <div class="modal-footer">
                    <button id="colse" type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">لاهنت ي بعدي ايميلك حتى ارسلك التصميم</h5>
            </div>
            <div class="modal-body">
                <form id="registerForm" class="form-horizontal" action="{{ url('/try/form3') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label class="control-label ml-2">اسمك الكريم</label><br>
                    <div class="input-group mb-3">
                        <input  id="name" type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}"  value="{{ old('name') }}" required autofocus>
                        <div class="input-group-append">
                            <span class=" input-group-text">  <i class="fa fa-user"></i></span>
                        </div>
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <label class="control-label ml-2">ايميلك</label><br>
                    <div class="input-group mb-3">
                        <input  id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}"  value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <span class=" input-group-text">  <i class="fa fa-envelope"></i></span>
                        </div>
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <label class="control-label ml-2">الرقم السري</label><br>
                    <div class="input-group mb-3">
                        <input  id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" required autofocus>
                        <div class="input-group-append">
                            <span class=" input-group-text">  <i class="fa fa-user"></i></span>
                        </div>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <p  class="mb-2" style="color: red">ملاحظة : الايميل والرقم السري راح تحتاجهم لدخول النظام المرات الجاية</p>
                    <div class="div-center">
                        <button  class="btn btn-success">حفظ وارسال </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">قائمة التصاميم</h5>
            </div>
            <div class="modal-body">
                <form id="changeTemplateForm" class="form-horizontal" action="{{ url('/try/form2') }}" method="post" style="display: inline;">
                    @csrf
                    <input type="hidden" name="changeTemplate">
                    <input type="hidden" name="anotherTemplate">
                    <input type="hidden" name="anotherTry" value="{{session()->get('CountOfTry')}}">
                    <div class="form-group select-img">
                        <h6 class="control-label">اختر التصميم</h6>
                        <div class="row">
                            @foreach($allTemplates as $template)
                            <div class="col-lg-6 col-sm-12">
                                <label>                                                                              <label>
                                    <input @if($FirstTemplateID == $template->id) checked @endif type="radio" name="TemplateID" value="{{$template->id}}">
                                    <div class="card mb-2 select-img">
                                        <div class="card-body">
                                            <img style="width: 200px; height: 360px;"src="{{ url('/') }}/img/storage/templates/{{$template->TemplateBackGroundName}}">
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn main-btn main-btn-sm  ml-2 mb-4"><i class="nav-icon fas fa-magic"></i> تصميم جديد</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>
@endsection
