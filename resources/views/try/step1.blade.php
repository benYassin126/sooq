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
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
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
                          <div class="col-lg-6 col-sm-12" style="border-left: 1px solid #eb36561f">
                            <div class="form-group">
                              <img style="width:150px;height: 110px; float: left;" src="/img/back.jpg">
                              <h6 class="control-label ml-2">صور منتجاتك ( مع خلفية)</h6>
                              <div>
                                <input type="file" name="WithBackGound[]" required style="max-width: 100%"  multiple="multiple"  accept="image/*"  />
                              </div>
                              @if($errors->has('WithBackGound.*'))
                              <p style="color: red;font-weight: bold;">تأكد من صيغ الملفات المدخلة وحجمها</p>
                              @endif
                            </div>
                          </div>
                          <div class="col-lg-6 col-sm-12 mb-30">
                            <div class="form-group">

                              <img style="width:150px;height:110px; float: left;" src="/img/trans.png">

                              <h6 class="control-label mb-2">صور منتجاتك ( بدون خلفية )</h6>
                              <div>
                                <input type="file" name="Transparent[]" style="max-width: 100%" required multiple="multiple"  accept="image/*" />
                              </div>
                              @if($errors->has('Transparent.*'))
                              <p style="color: red;font-weight: bold;">تأكد من صيغ الملفات المدخلة وحجمها</p>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="text-center mt-4">
                           <span style="color: #EB3656;">* لو ماعندك صور بدون خلفية .. </span><a  target="_blank" href="https://www.remove.bg">[ اضغط هنا لتفريغ الصور  ]</a>
                        </div>

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
