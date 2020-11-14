@extends('user.layouts.userLTE')
@section('title','لوحة التحكم')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- Strat MSG -->
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="display-success">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session()->has('erorr'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="display-success">
            <strong>{{ session()->get('erorr') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert-dismissible  alert alert-danger" id="display-success">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- End MSG -->
        <!-- Start Content -->
        @isset($newUser)
        <br>
        <h2 class="purple-text text-center"><strong>تم إرسال الصور</strong></h2> <br>
        <div class="row justify-content-center">
            <div class="col-3 text-center"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
        </div> <br><br>
        <div class="row justify-content-center">
            <div class="col-7 text-center">
                <h5 class="purple-text text-center">رسلتلك الايميل  .. اذا ماحصلتها في البريد الوارد اتوقع تحصلها في الرسائل الغير مرغوب بها .. ونورت الحتة الله يسعدك :)</h5>
            </div>
        </div>
        <hr>
        @endisset
        <br>
        <h4 class="text-center ">مرحبا بك في لوحة التحكم</h4>
        <div class="row showTemplate">
            <div class="col-sm-12 mt-4">
                <div class=" text-center ">
                    @if($allImgTrans != null && $allImgBack != null)
                    <form id="changeTemplateForm" class="form-horizontal" action="{{ url('/try/form2') }}" method="post" style="display: inline;">
                        @csrf
                        <input type="hidden" name="anotherTry" value="0">
                        <input type="hidden" name="oldUser" value="3">
                        <input type="hidden" name="UserID" value="{{auth::id()}}">
                        <button class="btn btn-primary  a3tmed mt-2"><i class="fas fa-magic"></i> تصميم جديد   </button>
                    </form>
                    <form id="changeTemplateForm" class="form-horizontal" action="{{ url('/text/addPrices') }}" method="post" style="display: inline;">
                        @csrf
                        <button class="btn btn-primary  mt-2 "><i class="fas fa-tags"></i>  إضافة الأسعار الى التصميم</button>
                    </form>

                    <form  class="form-horizontal" action="{{ url('/home/dwonloadAllImages') }}" method="post" style="display: inline;">
                        @csrf
                        <button class="btn btn-primary mt-2 "><i class="fas fa-download"></i>  تحميل جميع الصور</button>
                    </form>


                    @else
                    <p>عشان أبدأ اصمملك .. احتاج منك ترفع صور مفرغة وبيئية  لاهنت</p>
                    <a href="{{ url('imgs') }} " class="btn btn-primary ">مكتبة الصور</a>
                    @endif

                </div>
            </div>
            @if(isset($allUserDesigns))
            <div class="col-sm-12">

                <div class=" text-center">

                    <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                        <!-- Start Show Template -->
                        <div class="MySlide mt-4" id='one' >
                            <div class="autoplay">

                                @forelse($allUserDesigns as $img)
                                <div> <img style="width: 100%;height: 100%;"  src="{{ url('/') }}/img/storage/user_designs/{{$img->TheImg}}.png"></div>
                                @empty
                                {{'ليس لديك تصميم حتى الآن'}}
                                @endforelse
                            </div>
                        </div>


                        <hr>

                        <!-- inst -->
                        <div class="MocUp text-center mt-2" id='inst'>
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
                                    @forelse($allUserDesigns as $img)
                                    <img class="imgesInMockUp"  src="{{ url('/') }}/img/storage/user_designs/{{$img->TheImg}}.png">
                                    @empty
                                    {{''}}
                                    @endforelse

                                    @if (count($allUserDesigns) < 12 )
                                    @for($i = 0; $i < (12 - count($allUserDesigns)); $i++)
                                    <img class="imgesInMockUp" src="/img/show.png">
                                    @endfor
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
</div>
@endsection('content')
