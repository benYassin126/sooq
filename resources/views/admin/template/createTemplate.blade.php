@extends('admin.layouts.adminLTE')
@section('title','القوالب')
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

  <div class="row">

<div class="card card-info mt-4 mb-4">
   <div class="card-header">
    <h3 class="card-title">تفضل برفع القالب</h3>
</div>
<!-- /.card-header -->
<!-- form start -->
<form class="form-horizontal" action="{{ route('template.store') }}" method="post" enctype="multipart/form-data">

    @include('admin.template._part._partFormAdd_Update')

    <div class="card-footer">
  <button type="submit" class="btn btn-success btn-block">حفظ القالب</button>

</div>


</form>
</div>
  </div>


  <!-- End Content -->

  @endsection('content')


