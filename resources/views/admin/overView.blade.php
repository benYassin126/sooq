@extends('admin.layouts.adminLTE')
@section('title','نظرة عامة')
@section('content')


<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <!-- Strat MSG -->
    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="display-success">
     <strong>{{ session()->get('message') }}</strong>
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

  <!-- Small boxes (Stat box) -->
  <div class="row">

  </div>
  <!-- /.row -->

  <!-- Main row -->



  @endsection('content')


