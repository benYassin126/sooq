@extends('admin.layouts.adminLTE')
@section('title','تعديل عامل')

@section('content')

<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    <!-- Strat MSG -->
    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>{{ session()->get('message') }}</strong>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <!-- END MSG -->
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <!-- Strat MSG -->

  <div class="card card-info mb-4">
   <div class="card-header">
    <h3 class="card-title" style="display: inline-block;">تعديل  القالب  [ {{$thisTemplate->TemplateName}} ]</h3>
    <form method="Post" action="{{route('template.destroy',$thisTemplate->id)}}" style="float: left;">
      @csrf
      @method('DELETE')
      <button onclick="return confirm('{{__('هل انت متاكد ؟')}}')" class="btn btn-danger "><i class="fas fa-trash-alt"></i>  حذف القالب </buttn>
      </form>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('template.update',$thisTemplate)}}" method="post" enctype="multipart/form-data">
      @method('PATCH')
      @include('admin.template._part._partFormAdd_Update')


      <div class="card-footer">

        <button type="submit" name="update" class="btn btn-success btn-block"> <i class="fas fa-edit fa-sm"></i> حفظ التعديلات  </button>

      </div>


    </form>

    <!-- /.card-body -->

  </div>

  <!-- /.card -->




  <!-- Horizontal Form -->




  @endsection('content')
