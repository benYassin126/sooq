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
                <li class="active"  id="imges"><strong>الصور</strong></li>
                <li  id="colors"><strong>هويتك</strong></li>
            </ul>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
            </div> <br>



            <div class="header-button wow fadeInUp" data-wow-delay="0.3s">


                <!-- Main content -->
                <div class="content">
                  <div class="container-fluid">
                    <!-- Strat MSG -->

                    <!-- End MSG -->

                    <!-- Start Content -->

                    <!-- Srtat Form -->
                    <div class="row">
                        <div class="card card-info  mb-4">
                           <div class="card-header">
                              <ul>
                                <li>يجب ان لايتجاوز حجم الصورة الواحدة     <span class="right badge badge-danger">  5 جيجا بايت  </span></li>
                                <li>الصيغ المسموح بها [ PNG , JPEG ,GIF,SVG ]</li>
                            </ul>
                        </div>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                            <div class="form-group">
                              <label class="control-label ml-2">الصور المفرغة</label><span class="right badge badge-praimary">نقصد بالصور المفرغة هي الصور التي لا تحتوي على اي خلفية ولا حتى خلفية بيضاء</span><br>
                              <p class="control-label ml-2">اذا كنت لا تملك صور مفرغة إليك هذه الأداة الرائعة</label><a _blank href="https://www.remove.bg"><span class="right badge badge-danger">اضغط هنا لتفريغ الصور</p></a>
                                <div>
                                   <input type="file" name="Transparent[]" required  multiple="multiple" />
                               </div>
                           </div>
                           <div class="form-group">
                              <label class="control-label ml-2">الصور البيئية</label><span class="right badge badge-praimary">نقصد بالصور البيئية هي الصور التي تحتوي على خلفية</span>
                              <div>
                                 <input type="file" name="WithBackGound[]" required  multiple="multiple"  />
                             </div>
                         </div>

                     </div>
                     <div class="div-center">
                      <button type="submit" class="btn btn-success">الخطوة التالية  <i class="fa fa-arrow-left mr-2"></i> </button>
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
