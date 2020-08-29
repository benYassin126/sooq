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
    <br>
    <h4 class="text-center mb-4">جميع تصاميم مستخدمي روّج</h4>
    <a  href="{{ url('admin/overView/allImages/deleteAll') }}" class="btn btn-danger btn-block">حذف جميع الصور</a>
    <br>




  <div class="row">
    @forelse($all as $img)
    <div class="col-md-6 col-lg-3 col-sm-12">
        <div class="card">

            <div class="card-body">
              <img style="width: 100%; height: 200px;" src="/{{$img}}">
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    @empty
    <div class=" alert alert-danger">
        <p>لا يوجد تصاميم</p>
    </div>

@endforelse



  </div>
  <!-- End Content -->
  @endsection('content')
