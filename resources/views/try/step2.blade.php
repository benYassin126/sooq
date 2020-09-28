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
                                {{( session()->get('Testing') )}}
                                <!-- Srtat Form -->
                                <div class="row">
                                    <div class="card card-info bg-color  mb-4" style="width:100%">
                                        <form id="ColorsForm"class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-12 mb-30" style="border-left: 1px solid #eb36561f">
                                                        @if ( session()->get('Testing') == 'B')
                                                        <div class="form-group select-img">
                                                            <h6 class="control-label">اختر التصميم</h6>
                                                            <div class="row">
                                                                @foreach($allTemplates as $template)
                                                                <div class="col-lg-6 col-sm-12">
                                                                    <label>                                                                              <label>
                                                                        <input @if($FirstTemplateID == $template->id) checked @endif type="radio" name="TemplateID" value="{{$template->id}}">
                                                                        <div class="card mb-2 select-img">
                                                                            <div class="card-body">
                                                                                <img style="width: 200px; height: 200px;" src="{{url('/')}}/admin/template/fetch_image/{{$template->id }}">
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        @endif
                                                        <div class="form-group mt-4 mb-2">
                                                            <p id="Coloralert" class="mb-4 alert alert-danger" style="font-weight: bold;display: none;">زودنا بألوان هويتك لاهنت</p>
                                                            <h6 class="control-label">لون الهوية الأساسي  (Hex) </h6>
                                                            <div>
                                                                <input type="color" name="PicMineColor" id= "PicMineColor" onchange="picMineFun()" >
                                                                <input id ="MineColor" type="text" name="MineColor" class="mr-2" style="width: 80px;" value="#010101" maxlength="7" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <h6 class="control-label">لون الهوية الثانوي  (Hex)</h6>
                                                            <div>
                                                                <input type="color" name="PicSubeColor" id= "PicSubColor" onchange="picSubeFun()" >
                                                                <input id ="SubColor" type="text" name="SubColor" class="mr-2" style="width: 80px;" value="#010101" maxlength="7" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12">
                                                        <div class="form-group">
                                                            <h6  class="control-label">نوع المطعم</h6>
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
                                                                <input id="phone" class="form-control" type="tel" name="PhoneNumber" placeholder="05xxxxxxx" minlength="10" maxlength="10" size="10"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="div-center">
                                                    <button type="submit" class="btn btn-success"> شوف المحتوى   <i class="fa fa-eye mr-2"></i> </button>
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
