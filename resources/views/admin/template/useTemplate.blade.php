@extends('admin.layouts.adminLTE')
@section('title','استخدام القالب')
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

  <!-- Srtat Form -->
  <div class="row">
    <div class="card card-info mt-4 mb-4">
     <div class="card-header">
      <h3 class="card-title">تفضل برفع الصور</h3>
      <br>
      <ul>
        <li>يجب ان لايتجاوز حجم الصورة الواحدة     <span class="right badge badge-danger">  5 جيجا بايت  </span></li>
        <li>الصيغ المسموح بها [ PNG , JPEG ,GIF,SVG , GIF ]</li>
      </ul>
    </div>
    <form class="form-horizontal" action="{{ route('template.useTemplate',$template->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label class="control-label ml-2">الصور المفرغة</label><span class="right badge badge-danger">{{{ isset($countOFTransparent) ? $countOFTransparent : '' }}}</span><br>
          <p class="control-label ml-2">اذا كنت لا تملك صور مفرغة إليك هذه الأداة الرائعة</label><a href="https://www.remove.bg"><span class="right badge badge-danger">اضغط هنا لتفريغ الصور</p></a>
            <div>
             <input type="file" name="Transparent[]"  multiple="multiple" />
           </div>
         </div>
         <div class="form-group">
          <label class="control-label ml-2">الصور البيئية</label><span class="right badge badge-danger">{{{ isset($countOFWithBackGound) ? $countOFWithBackGound : '' }}}</span>
          <div>
           <input type="file" name="WithBackGound[]"  multiple="multiple"  />
         </div>
       </div>

       <div class="form-group">
        <label class="control-label">اللون الأساسي لهوية العميل(Hex)</label> <span style="color: green">اختياري</span>
        <div>
         <input type="color" name="MineColor" value={{$template->MineColor}}>
       </div>
     </div>

     <div class="form-group">
      <label class="control-label">اللون الثانوي لهوية العميل  (Hex)</label> <span style="color: green">اختياري</span>
      <div>
       <input type="color" name="SubColor" value={{$template->SubColor}}>
     </div>
   </div>

   <div class="form-group">
    <label class="control-label">اللون الثانوي الاضافي لهوية العميل(Hex)</label>  <span style="color: green">اختياري</span>
    <div>
     <input type="color" name="SubSubColor" value={{$template->SubSubColor}}>
   </div>
 </div>

</div>
<div class="card-footer">
  <button type="submit" class="btn btn-success btn-block">استخدام القالب</button>
</div>
</form>
</div>
</div>
<!-- End Form -->

<!-- Start Show Template -->
<hr>
<h3 class="text-center mt-4 mb-4">شكل القالب</h3>
<div class="MocUp text-center">
  @if(isset($allImgPath))
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
      @forelse($allImgPath as $imgPath)

      <img class="imgesInMockUp" src="/img/output/{{$imgPath}}.png">



      @empty
      {{'pre'}}
      @endforelse
    </div>
  </div>

  @endif
</div>

<!-- end Show Template -->



<!-- End Content -->


@endsection('content')


