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
                <h3>تصميمك جاهز :)</h3>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class=" text-center">
                    <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                        <!-- Start Show Template -->
                        <form class="form-horizontal">
                            <select class="form-control mb-4" onchange='CheckPhoneType(this.value);'>
                                <option value="inst" selected>شكل المحتوى في الانستقرام</option>
                                <option value="tweet">شكل المحتوى في تويتر</option>
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
                                    @forelse(session()->get('allImgPath.path') as $key => $img)
                                    <img class="imgesInMockUp" src="/img/output/{{$img}}.png">
                                    @empty
                                    {{'pre'}}
                                    @endforelse
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
                                    <img class="imgesInMockUp" style="width: 80%;margin-top: -461px" src="/img/output/[1]__{{$allImgPath[0] - 300}}.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class=" text-center">
                    <h3>ها شرايك ؟ </h3>
                    <img style="width: 70px;height: 60px; display: inline-block;" src="/img/face.gif">
                    <h6 style="display: inline-block;">تصميمك رهيب .. ارسلها على الايميل لاهنت</h6>
                    <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal3">كمل البيانات وأرسل على الايميل</button>
                    <br>
                    <hr>
                    <img style="width: 64px;height: 50px;" src="/img/face1.gif">
                    <h6 style="display: inline-block;">والله ياخوك ماقصرت .. لكن عندي بعض التعديلات لاهنت</h6>
                    <button class="btn btn-info "  data-toggle="modal" data-target="#exampleModal">عدل على التصميم</button>
                    @if( session()->get('CountOfTry') == 1)
                    <hr>
                    <img style="width: 77px;height: 70px;" src="/img/face2.gif">
                    <h6 style="display: inline-block;">عندي لك فكرة .. شرايك نغيير الشكل ؟ .. اتوقع راح يكون شي خرافي</h6>
                    <form id="myForm" class="form-horizontal" action="{{ url('/try/form2') }}" method="post">
                        @csrf
                        <input type="hidden" name="changeTemplate">
                        <input type="hidden" name="anotherTry" value="{{session()->get('CountOfTry')}}">
                         <input type="submit" class="btn btn-success" value="غير الشكل">
                    </form>
                    @endif
                    @if( session()->get('CountOfTry') > 1)
                    <hr>
                    <img style="width: 77px;height: 70px;" src="/img/face2.gif">
                    <h6 style="display: inline-block;">عندي لك فكرة .. شرايك نغيير الشكل ؟ .. اتوقع راح يكون شي خرافي</h6>
                    <button style="display: inline-block;" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal2">غير الشكل</button>
                    <form id="myForm" style="display: inline-block;" class="form-horizontal" action="{{ url('/try/form2') }}" method="post">
                        @csrf
                        <input type="hidden" name="changeTemplate">
                        <input type="hidden" name="anotherTry" value="{{session()->get('CountOfTry')}}">
                        <input type="submit" class="btn btn-success" value="الشكل السابق">
                    </form>
                    @endif
                </div>
            </div>
            <!-- end Show Template -->
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
                <form class="form-horizontal" action="{{ url('/try/form2') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="anotherTry" value="{{session()->get('CountOfTry')}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label ml-2">الصور المفرغة</label><br>
                            <p class="control-label ml-2">اذا كنت لا تملك صور مفرغة إليك هذه الأداة الرائعة</label><a _blank href="https://www.remove.bg"><span class="right badge badge-danger">اضغط هنا لتفريغ الصور</p></a>
                            <div>
                                <input type="file" name="Transparent[]"   multiple="multiple" />
                            </div>
                            @if($errors->has('Transparent.*'))
                            <p style="color: red;font-weight: bold;">تأكد من صيغ الملفات المدخلة وحجمها</p>
                            @endif
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label ml-2">الصور البيئية</label>
                            <div>
                                <input type="file" name="WithBackGound[]"   multiple="multiple"  />
                            </div>
                            @if($errors->has('WithBackGound.*'))
                            <p style="color: red;font-weight: bold;">تأكد من صيغ الملفات المدخلة وحجمها</p>
                            @endif
                        </div>
                        <hr>
                        <a class="btn btn-dark" onclick="replaceColor();" style="float: left;">عكس الآلوان  </a>
                        <a class="btn btn-dark" onclick="defultColor();" style="float: right;">الألوان الافتراضية</a>
                        <div class="form-group">
                            <label class="control-label mt-4">لون الهوية الأساسي  (Hex)</label>
                            <div>
                                <input type="color" id="MineColor" name="MineColor" value="{{ session()->get('MineColor') }}">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label">لون الهوية الثانوي  (Hex)</label>
                            <div>
                                <input type="color" id="SubColor" name="SubColor" value="{{ session()->get('SubColor') }}">
                            </div>
                        </div>
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
                <h5 class="modal-title" id="exampleModalLabel">ودي أخدمك اكثر لكن للأسف :(</h5>
            </div>
            <div class="modal-body">
                <p>عزيزي تذكر ان هذه نسخة تجريبية للمنصة .. يسعدنا كثييير لو تقدملنا ملاحظاتك على التصميم .. صدقني راح اكون ممتن لك بشكل كبيير</p>
                <form method='post' action="" onsubmit="return post();">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label ml-2">وش هي العيوب والمشاكل اللي واجهتك ؟</label><br>
                            <div>
                                <textarea class="form-control" id="msg" name="msg"></textarea>
                            </div>
                        </div>
                        <div class="div-center">
                            <button type="submit" id="submit" value="Submit"  class="btn btn-success">ارسل ملاحظاتك </button>
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
                <h5 class="modal-title" id="exampleModalLabel">خطوة واحدة تفصلنا .. تسجيلك يضمن لك الوصول لمحتواك والتعديل عليه في  اي وقت</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ url('/try/form3') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label class="control-label ml-2">اسمك الكريم</label><br>
                    <div class="input-group mb-3">
                        <input  id="name" type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}"  value="{{ old('name') }}" required autofocus>
                        <div class="input-group-append">
                            <span class="fa fa-user  input-group-text"></span>
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
                            <span class="fa fa-envelope  input-group-text"></span>
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
                            <span class="fa fa-lock input-group-text"></span>
                        </div>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
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
    @endsection
