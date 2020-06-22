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
  <h4 class="text-center mb-4">قوالب النظام</h4>
  <br>
    <a href="{{ route('template.create') }}" class="btn btn-success btn-block mb-4">إضافة قالب</a>
  <div class="row">
    @forelse($allTemplates as $template)
    <div class="col col-4">
        <div class="card">
            <div class="card-header text-center">
                <a href="{{ route('template.show',$template->id) }}">  {{$template->TemplateName}} </a>
            </div>
            <div class="card-body">
                <a href="{{ route('template.show',$template->id) }}"> <img class="card-img-top" src="template/fetch_image/{{$template->id }}"></a>
            </div>
            <div class="card-footer"><a href="{{ route('template.show',$template->id) }}" class="btn btn-primary btn-block">إدارة القالب</a></div>
        </div>
    </div>
    @empty
    <div class=" alert alert-danger">
        <p>لا توجد قوالب لعرضها</p>
    </div>

@endforelse

    </div>

  </div>


  <!-- End Content -->

  @endsection('content')


