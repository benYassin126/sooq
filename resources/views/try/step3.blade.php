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
            <div class="chatbox-holder">
                <div class="chatbox chatbox-min">
                    <div class="chatbox-top">
                        <div class="chatbox-avatar">
                            <a target="_blank"><img src="/img/mor.png"/></a>
                        </div>
                        <div href="javascript:void(0);" class="chat-partner-name">
                            <span class="status online"></span>
                            <a href="javascript:void(0);">{{ config('app.name') }}</a>
                        </div>
                        <div class="chatbox-icons">
                            <a href="javascript:void(0);"><i class="fa fa-minus"></i></a>
                            <a href="javascript:void(0);"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    @if( session()->get('CountOfTry') == null || session()->get('CountOfTry') == 0 )
                    <div class="chat-messages">
                        <div class="message-box-holder">
                            <div class="message-box">
                                هلا والله ومسهلا .. تصميمك الآن جاهز .. شرايك ؟
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal3">ممتاز جدا .. ارسلها على الايميل <i class="fas fa-check"></i></button>
                        <button class="btn btn-block btn-info "  data-toggle="modal" data-target="#exampleModal">عندي بعض التعديلات على الصور والالوان <i class="fas fa-edit"></i></button>
                    </div>
                    @endif
                    @if(session()->get('CountOfTry') == 1 )
                    <div class="chat-messages">
                        <div class="message-box-holder">
                            <div class="message-box">
                                إذا ماعجبك .. خلني اصمملك تصميم ثاني
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        @guest
                        <button class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal3">الأن التصميم مررة رهيب .. ارسله على الايميل <i class="fas fa-check"></i></button>
                        @endauth
                        @if (!Auth::guest())
                        <form id="a3tmed" action="{{ url('/try/form4') }}"  class="form-horizontal" method="post">
                            @csrf
                            <input type="hidden" name="UserID" value="{{Auth::id()}}">
                            <button class="btn btn-block btn-success">أعتمد التصميم <i class="fas fa-check"></i></button>
                        </form>
                        <button class="btn btn-block btn-info "  data-toggle="modal" data-target="#exampleModal">التصميم رهيب .. لكن بعدل على الصور والألوان <i class="fas fa-edit"></i></button>
                        <form id="changeTemplateForm" class="form-horizontal" action="{{ url('/try/form2') }}" method="post">
                            @csrf
                            <input type="hidden" name="changeTemplate">
                            <input type="hidden" name="anotherTry" value="{{session()->get('CountOfTry')}}">
                            <input type="submit" class="btn btn-secondary  btn-block mt-2 " value="ابغى تصميم مختلف">
                        </form>
                    </div>
                    @endif
                    @if(session()->get('CountOfTry') > 1 )
                    <div class="chat-messages">
                        <div class="message-box-holder">
                            <div class="message-box">
                                إذا ماعجبك .. خلني اصمملك تصميم ثاني
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        @guest
                        <button class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal3">الأن التصميم مررة رهيب .. ارسله على الايميل <i class="fas fa-check"></i></button>
                        <button class="btn btn-block btn-info "  data-toggle="modal" data-target="#exampleModal">التصميم رهيب .. لكن بعدل على الصور والألوان  <i class="fas fa-edit"></i></button>
                        @endauth
                        @if (!Auth::guest())
                        <form id="a3tmed" action="{{ url('/try/form4') }}"  class="form-horizontal" method="post">
                            @csrf
                            <input type="hidden" name="UserID" value="{{Auth::id()}}">
                            <button class="btn btn-block btn-success">أعتمد التصميم <i class="fas fa-check"></i></button>
                        </form>
                        <button class="btn btn-block btn-info "  data-toggle="modal" data-target="#exampleModal">جرب تعدل الألوان <i class="fas fa-edit"></i></button>
                        @endif
                        <button class="btn btn-dark float-left mt-4"  data-toggle="modal" data-target="#exampleModal2">ابغى تصميم مختلف <i class="fas fa-exchange-alt"></i></button>
                        <form id="changeTemplateForm" class="form-horizontal float-right mt-4" action="{{ url('/try/form2') }}" method="post">
                            @csrf
                            <input type="hidden" name="changeTemplate">
                            <input type="hidden" name="anotherTry" value="{{session()->get('CountOfTry')}}">
                            <input type="submit" class="btn btn-secondary " value="التصميم السابق">
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class=" text-center">
                    <h3>ها شرايك ؟ </h3>
                    <button class="btn btn-primary btn-lg a3tmed mt-2 mb-4">اعتمد / عدل <i class="fas fa-check"></i><i class="fas fa-edit"></i></button>
                </div>
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
                                    <img class="imgesInMockUp" style="width: 80%;margin-top: -461px" src="/img/output/{{$img}}.png">
                                </div>
                            </div>
                        </div>
                    </div>
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
                <form id="tryForm" class="form-horizontal" action="{{ url('/try/form2') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="anotherTry" value="{{session()->get('CountOfTry')}}">
                    <div class="card-body">
                        @guest
                        <div class="form-group">
                            <label class="control-label ml-2">الصور المفرغة</label><br>
                            <p class="control-label ml-2">هذي الأداة بتساعدك كثيير في تفريغ الصور </label><a target=" _blank" href="https://www.remove.bg"><span class="right badge badge-danger"> اضغط هنا لتفريغ الصور </p></a>
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
                        @endauth
                        <a class="btn btn-dark" onclick="replaceColor();">عكس الآلوان  </a>
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
@endsection
