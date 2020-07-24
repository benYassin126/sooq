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
                  <div class="card card-info  mb-4">
                    <div class="card-header">
                      <ul>
                        <li>لاهنت حاول يكون حجم الصور اقل من <span class="right badge badge-danger">  5 ميجابايت  </span></li>
                        <li>وصيغهم يكون وحدة من ذول [ PNG , JPEG ,GIF,SVG ]</li>
                      </ul>
                    </div>
                    <form id="uploadImgsForm" class="form-horizontal" action="{{ url('/try/form1') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label class="control-label ml-2">الصور المفرغة</label><span class="right badge badge-praimary">أقصد بالصور المفرغة هي الصور اللي مالها خلفية .. ولا حتى خلفية بيضاء ( شفاف )</span><br>
                          <p class="control-label ml-2"></label>اذا ما كان عندك صور مغرغة .. جبتلك اداة تظبطك وتحول صورك لمفرغة في ثواني <a target="_blank"  href="https://www.remove.bg"><span class="right badge badge-danger mb-2"> اضغط هنا لتفريغ صورك :)</p></a>
                          <div>
                            <input type="file" name="Transparent[]"  required multiple="multiple" />
                          </div>
                          @if($errors->has('Transparent.*'))
                          <p style="color: red;font-weight: bold;">تأكد من صيغ الملفات المدخلة وحجمها</p>
                          @endif
                        </div>
                        <hr>
                        <div class="form-group">
                          <label class="control-label ml-2">الصور البيئية</label><span class="right badge badge-praimary mb-2">هنا أقصد الصور اللي لها خلفية ( الصور العادية )</span>
                          <div>
                            <input type="file" name="WithBackGound[]" required  multiple="multiple"  />
                          </div>
                          @if($errors->has('WithBackGound.*'))
                          <p style="color: red;font-weight: bold;">تأكد من صيغ الملفات المدخلة وحجمها</p>
                          @endif
                        </div>
                      </div>
                      <div class="div-center">
                            <button type="button" class="btn btn-secondary mb-2" data-toggle="modal" data-target="#explaneModal">مثال للصور المفرغة والبيئية</button>
                            <button  type="submit" class="btn btn-success">الخطوة التالية  <i class="fa fa-arrow-left mr-2"></i> </button>
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
</div>
</div>

<div class="modal fade" id="explaneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">وش أقصد بالصور المفرغة والبيئية ؟</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col col-sm-6" style="border-left: 1px solid hsla(230,7%,84%,1)">
            <h4>الصور المفرغة</h4>
            <img style="width: 280px;height: 200px;" src="/img/trans.png">
            <p  style="color: red">لاحظت ان الصورة مالها خلفية ؟</p>
            <hr>
          </div>

          <div class="col col-sm-6">
            <h4>الصور  البيئية</h4>
            <img style="width: 250px;height: 200px;" src="/img/back.jpg">
            <p style="color: red"> لاحظ معي ان الصورة لها خلفية</p>
            <hr>
          </div>
        </div>
      </div>
      <div class="modal-footer">
 <a  target="_blank"  href="https://www.remove.bg" class="btn btn-success ml-2" >اداة تفريغ الصور</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">تمام .. فهمت عليك</button>
      </div>
    </div>
  </div>
</div>

<!-- Hero Area End -->
@endsection
