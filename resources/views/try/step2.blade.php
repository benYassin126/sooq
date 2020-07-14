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
                                <li>محتواك جاهز الآن .. اذا حاب يطلع المحتوى بشكل أفضل زودنا بتفاصيل   هويتك :)</li>
                            </ul>
                        </div>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">نشاطك التجاري</label><span style="color: red">*</span>
                                <select name="BusinessType" class="form-control" onchange='CheckBusinessType(this.value);'>
                                    <option value="" disabled>اختر نشاط</option>
                                    <option>ألعاب</option>
                                    <option >إلكترونيات</option>
                                    <option >احتياجات المنزل</option>
                                    <option value="4">حياكة، أعمال يدوية وتجهيزات حفلات</option>
                                    <option value="14">خدمات</option>
                                    <option value="7">صحة ولياقة</option>
                                    <option value="12">قرطاسية</option>
                                    <option value="1">كتب</option>
                                    <option value="11">مأكولات ومشروبات</option>
                                    <option value="3">مجوهرات وإكسسوارات</option>
                                    <option value="2">ملابس وأحذية</option>
                                    <option value="9">ملحقات السيارة</option>
                                    <option value="8">منتجات التجميل والعناية بالبشرة</option>
                                    <option value="13">هدايا</option>
                                    <option value="others">أخرى</option>
                                </select>
                                <input placeholder="أدخل نشاطك التجاري *" id="OtherBusinessType" class="form-control mt-2" type="text" name="OtherBusinessType" style='display:none;'>
                            </div>
                            <div class="form-group">
                                <label class="control-label">لون الهوية الأساسي  (Hex)</label><span style="color:black;font-size: 14px;">اختيارك الصحيح لألوان هويتك يساعدنا  في صناعة المحتوى بشكل مخصص</span>
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
                                <label class="control-label">حساب  الانستقرام</label><span style="color: red">*</span>
                                <div>
                                   <input class="form-control" type="text" name="inst" placeholder="instAccount">
                               </div>
                           </div>

                            <div class="form-group">
                                <label class="control-label">حساب التويتر</label>
                                <div>
                                   <input class="form-control" type="text" name="twitter" placeholder="twitter" >
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
