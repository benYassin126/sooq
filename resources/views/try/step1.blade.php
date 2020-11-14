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
                        <li class="active"  id="imges"><strong>صور منتجاتك</strong></li>
                        <li  id="colors"><strong>هويتك</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                    </div> <br>
                    <!-- Strat MSG -->
                    @if(session()->has('erorr'))
                    <div style="top:200px !important;" class="alert alert-danger alert-dismissible fade show" role="alert" id="display-success">
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
                    <!-- Strat MSG -->
                    <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                        <!-- Main content -->
                        <div class="content">
                            <div class="container-fluid">
                                <!-- Srtat Form -->
                                <div class="row">
                                    <div class="card card-info  mb-4 bg-color" >
                                        <form id="uploadImgsForm" class="form-horizontal" action="{{ url('/try/form1') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12 col-sm-12" style="border-bottom: 1px solid #eee; padding: 10px;">
                                                        <div class="form-group">
                                                            <h6 class="control-label ml-2 mb-0">الشعار </h6><span class="mb-2 mt-0">أو صورة تحوي على الوان الهوية     </span><br>
                                                            <div class="fileUpload ">
                                                                <span class="fileName"></span>
                                                                <input name="Logo" id="uploadBtn" type="file" class="uploadBtn" accept="image/*" required />
                                                                <span class="customUploadBtn">تحميل</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="col-lg-6 col-sm-12 mt-4">
                                                        <div class="form-group">
                                                           {{-- <img style="width:150px;height: 110px; float: left; padding: 10px;" src="/img/back.jpg">--}}
                                                             <h6 class="control-label ml-2 mb-0">الصور البيئية </h6><span class="mb-2 mt-0">الصور التي تحتوي على خلفية</span><br>
                                                            <div class="fileUpload">
                                                                <span class="fileName"></span>
                                                                <input name="WithBackGound[]" id="uploadBtn" type="file" class="uploadBtn" multiple="multiple"  accept="image/*" />
                                                                <span class="customUploadBtn">تحميل</span>
                                                            </div>
                                                            @if($errors->has('WithBackGound.*'))
                                                            <p style="color: red;font-weight: bold;">تأكد من صيغ الملفات المدخلة وحجمها</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 mt-4" >
                                                        <div class="form-group">
                                                             {{--<img style="width:150px;height: 110px; float: left;  padding: 10px;" src="/img/trans.jpg">--}}
                                                             <h6 class="control-label ml-2 mb-0">الصور المفرغة </h6><span class="mb-2 mt-0">الصور التي لا تحتوي على خلفية ( ذات خلفية بيضاء ) </span><br>
                                                            <div class="fileUpload">
                                                                <span class="fileName"></span>
                                                                <input name="Transparent[]" id="uploadBtn" type="file" class="uploadBtn" multiple="multiple"  accept="image/*" />
                                                                <span class="customUploadBtn">تحميل</span>
                                                            </div>
                                                            @if($errors->has('Transparent.*'))
                                                            <p style="color: red;font-weight: bold;">تأكد من صيغ الملفات المدخلة وحجمها</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                {{--
                                                <div class="text-center mt-4">
                                                    <span style="color: #EB3656;">* لو ماعندك صور بدون خلفية .. </span><a  target="_blank" href="https://www.remove.bg">[ اضغط هنا لتفريغ الصور  ]</a>
                                                </div>
                                                --}}
                                                <div class="div-center">
                                                    <button  type="submit" class="btn btn-success mt-4">الخطوة التالية  <i class="fa fa-arrow-left mr-2"></i> </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Form -->
                            </div>
                            <!-- /.login-card-body -->
                            <!-- Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    @endsection
