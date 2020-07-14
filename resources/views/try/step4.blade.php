@extends('layouts.app')

@section('content')
<!-- Hero Area Start -->
<div id="hero-area" class="hero-area-bg">
  <div class="container">
    <div class="row showTemplate">
        <div class="col-md-12 col-sm-12 text-center welcomeText">
            <h3>تصميمك جاهز :)</h3>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class=" text-center">
              <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                <!-- Start Show Template -->
                <form class="form-horizontal">
                    <select class="form-control mb-4" onchange='CheckPhoneType(this.value);'>
                        <option value="inst" selected>شكل المحتوى في الانستقرام</option>
                        <option value="tweet">شكل المحتوى في تويتر</option>
                    </select>
                </form>


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
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
                    <img class="imgesInMockUp" src="/img/output/Template365.png">
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
            <img class="imgesInMockUp" style="width: 80%;margin-top: -461px" src="/img/output/Template365.png">
        </div>
    </div>


</div>


</div>
</div>
</div>





<div class="col-md-6 col-sm-6">
    <div class=" text-center">
        <h3>ها شرايك ؟ </h3>
        <img style="width: 70px;height: 60px; display: inline-block;" src="/img/face.gif">
        <h6 style="display: inline-block;">تصميمك رهيب .. ارسلها على الايميل لاهنت</h6>
        <button class="btn btn-success">كمل البيانات وأرسل على الايميل</button>
        <br>
        <hr>
        <img style="width: 64px;height: 50px;" src="/img/face1.gif">
        <h6 style="display: inline-block;">والله ياخوك ماقصرت .. لكن عندي بعض التعديلات لاهنت</h6>
        <button class="btn btn-info "  data-toggle="modal" data-target="#exampleModal">عدل على التصميم</button>
    </div>
</div>

<!-- end Show Template -->

</div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ساعدني في الوصول لمحتوى رهيب</h5>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" action="{{ url('/try/form2') }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="anotherTry" value="test">
          <div class="card-body">
            <div class="form-group">
              <label class="control-label ml-2">الصور المفرغة</label><br>
              <p class="control-label ml-2">اذا كنت لا تملك صور مفرغة إليك هذه الأداة الرائعة</label><a _blank href="https://www.remove.bg"><span class="right badge badge-danger">اضغط هنا لتفريغ الصور</p></a>
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
         <a class="btn btn-dark" onclick="replaceColor();" style="float: left;">عكس الآلوان  </a>
         <a class="btn btn-dark" onclick="defultColor();" style="float: right;">الألوان الافتراضية</a>
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





<!-- Hero Area End -->
@endsection
