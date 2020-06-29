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
    </div>
    <form class="form-horizontal" action="{{ route('template.useTemplate',$template->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label class="control-label ml-2">الصور المفرغة</label><span class="right badge badge-danger">{{{ isset($countOFTransparent) ? $countOFTransparent : '' }}}</span>
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
<h3 class="text-center mt-4">قوالب النظام</h3>
<div class="row">

</div>

<!-- end Show Template -->



<!-- End Content -->


@endsection('content')


