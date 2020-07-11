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
                <li id="imges"><strong>الصور</strong></li>
                <li  class="active"    id="colors"><strong>هويتك</strong></li>
            </ul>
            <div class="progress">
                <div class="progress-barComplate progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
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
                                <li>محتواك جاهز الآن .. اذا حاب يطلع المحتوى بشكل أفضل عطنا معلومات هويتك :)</li>
                                <li><span class="right badge badge-danger">كل الحقول اختيارية .. اذا مستعجل تقدر تسوي سكيب :)</span></li>
                            </ul>
                        </div>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">لون الهوية الأساسي  (Hex)</label>
                                <div>
                                   <input type="color" name="MineColor"{{isset($thisTemplate) ? 'value=' . $thisTemplate->MineColor .'': 'value=#010101'}} >
                               </div>
                           </div>

                           <div class="form-group">
                            <label class="control-label">لون الهوية الثانوي  (Hex)</label>
                            <div>
                               <input type="color" name="SubColor" {{isset($thisTemplate) ? 'value=' . $thisTemplate->SubColor .'' : 'value=#010101'}}>
                           </div>
                       </div>
                            <div class="form-group">
                                <label class="control-label">حساب التويتر</label>
                                <div>
                                   <input class="form-control" type="text" name="twitter" placeholder="twitter">
                               </div>
                           </div>
                            <div class="form-group">
                                <label class="control-label">حساب  الانستقرام</label>
                                <div>
                                   <input class="form-control" type="text" name="inst" placeholder="instAccount">
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
