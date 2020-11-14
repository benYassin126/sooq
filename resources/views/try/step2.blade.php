@extends('layouts.app')
@section('content')
<!-- Hero Area Start -->
<div id="hero-area" class="hero-area-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="MultiForm text-center">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li id="imges"><strong>صور منتجاتك</strong></li>
                        <li  class="active"    id="colors"><strong>هويتك</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-barComplate progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div> <br>
                    <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                        <!-- Main content -->
                        <div class="content">
                            <div class="container-fluid">
                                {{-- ( session()->get('Testing') ) --}}
                                <!-- Srtat Form -->
                                <div class="row">
                                    <div class="card card-info bg-color  mb-4" style="width:100%">
                                        <form id="ColorsForm"class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-12 mb-30"  @if ( session()->get('Testing') == 'B5' || session()->get('Testing') == 'A5') style="display: none;"  @endif>

                                                        <div class="form-group select-img">
                                                            <h6 class="control-label">اختر التصميم</h6>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-sm-12">
                                                                    <div class="scrollmenu">
                                                                        @foreach($allTemplates as $template)
                                                                        <label>
                                                                            <input @if($FirstTemplateID == $template->id) checked @endif type="radio" name="TemplateID" value="{{$template->id}}">
                                                                            <div class="card mb-2 select-img">
                                                                                <div class="card-body">
                                                                                    <img style="width: 175px; height: 360px;"  src="{{ url('/') }}/img/storage/templates/{{$template->TemplateBackGroundName}}">
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-6 col-sm-12">
                                                        <div class="form-group">
                                                            <h6  class="control-label">نوع النشاط</h6>
                                                            <select  name="BusinessType" class="form-control" onchange='CheckBusinessType(this.value);'>
                                                                <option value="" disabled>اختر نشاط</option>
                                                                <option value="cofy">كوفي شوب</option>
                                                                <option value="borgar">برجر</option>
                                                                <option value="shawrma">شاورما</option>
                                                                <option value="brost">بروست</option>
                                                                <option value="mshweat">مشويات</option>
                                                                <option value="pizza">بيتزا</option>
                                                                <option value="flafel">فلافل</option>
                                                                <option value="mandy">شعبيات ( رز - دجاج )</option>
                                                                <option value="ftor">شعبيات ( فطور )</option>
                                                                <option value="others">اخرى</option>
                                                            </select>
                                                            <input placeholder="نوع مطعمك*" id="OtherBusinessType" class="form-control mt-2" type="text" name="OtherBusinessType" style='display:none;'>
                                                        </div>
                                                        <div class="form-group mt-4">
                                                            <h6 class="control-label">رقم الجوال</h6>
                                                            <div>
                                                                <input id="phone" class="form-control mb-2" type="tel" name="PhoneNumber" placeholder="05xxxxxxx" minlength="10" maxlength="10" size="10" required >
                                                            </div>
                                                        </div>
                                                        <hr>

                                                        @if ($LogoColors == null)
                                                          <p class="text-center">لإختيار الألوان من الشعار قم   ب[ <a  href="javascript:history.back(1)">رفع الشعار</a> ]</p>
                                                        @endif
                                                        <div class="form-group mt-4 mb-2 select-color">
                                                            <p id="Coloralert" class="mb-4 alert alert-danger" style="font-weight: bold;display: none;">زودنا بألوان هويتك لاهنت</p>
                                                            <h6 class="control-label ">اللون الأساسي</h6>
                                                            @if ($LogoColors != null)
                                                           {{-- <p class="ml-2" style="display: inline;">اختر من الهوية :</p> --}}
                                                            <label>
                                                                <input type="radio" name="MineColor">
                                                                <span onclick="selectMineFun('{{$LogoColors[0]}}')" class="ColorGrups" style="background:{{$LogoColors[0]}}"></span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="MineColor">
                                                                <span onclick="selectMineFun('{{$LogoColors[1]}}')" class="ColorGrups" style="background:{{$LogoColors[1]}}"></span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="MineColor">
                                                                <span onclick="selectMineFun('{{$LogoColors[2]}}')" class="ColorGrups" style="background:{{$LogoColors[2]}}"></span>
                                                            </label>
                                                            @endif
                                                            <span class="MinePalateButton mr-2"> <i class="fas fa-fill-drip"></i> </span>
                                                            <br>

                                                            <div id="MineColorPalete" style="display: none;">
                                                                <span class="mt-2 ml-2"> لوحة الألوان</span>
                                                                <div style="display: inline;">
                                                                    <div class="MainecolorPickSelector"></div>
                                                                    <input id ="MineColor" type="text" name="MineColor" class="mr-2" style="width: 80px;"  maxlength="7" >
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <hr>
                                                        <div class="form-group select-color">
                                                            <h6 class="control-label ">اللون الثانوي</h6>
                                                            @if ($LogoColors != null)

                                                            <label>
                                                                <input  type="radio" name="SubColor">
                                                                <span onclick="selectSubFun('{{$LogoColors[0]}}')" class="ColorGrups" style="background:{{$LogoColors[0]}}"></span>
                                                            </label>
                                                            <label>
                                                                <input  type="radio" name="SubColor" >
                                                                <span onclick="selectSubFun('{{$LogoColors[1]}}')" class="ColorGrups" style="background:{{$LogoColors[1]}}"></span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="SubColor">
                                                                <span onclick="selectSubFun('{{$LogoColors[2]}}')" class="ColorGrups" style="background:{{$LogoColors[2]}}"></span>
                                                            </label>

                                                            @endif

                                                            <span class="SubPalateButton mr-2"> <i class="fas fa-fill-drip"></i> </span>
                                                            <br>

                                                            <div id="SubColorPalete" style="display: none;">
                                                                <span class="mt-2 ml-2"> لوحة الألوان</span>
                                                                <div style="display: inline;">
                                                                    <div class="SubcolorPickSelector"></div>
                                                                    <input id ="SubColor" type="text" name="SubColor" class="mr-2" style="width: 80px;"  maxlength="7" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                                                                    <div class="div-center mt-4">
                                                        <button type="submit" class="btn btn-success"> شوف المحتوى   <i class="fa fa-eye mr-2"></i> </button>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Form -->
                            </div>
                            <!-- /.login-card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Hero Area End -->
@endsection
