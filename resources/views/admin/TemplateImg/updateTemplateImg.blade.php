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

    <div class="col col-4 card card-info mt-4 mb-4">
     <div class="card-header">
        <h3 class="card-title">أدخل الاحداثيات المناسبة ثم اضغط اختبار</h3>

    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form class="form-inline" action="{{ route('templateImg.update',$thisImg->id) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="card-body">
          <label class="sr-only" for="X">X</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text">X</div>
          </div>
          <input type="number" name="dst_x" value="{{$thisImg->dst_x}}" class="form-control" id="X" placeholder="x-coordinate">
      </div>

          <label class="sr-only" for="Y">Y</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text">Y</div>
          </div>
          <input type="number" name="dst_y"  value="{{$thisImg->dst_y}}"class="form-control" id="Y" placeholder="y-coordinate">
      </div>

          <label class="sr-only" for="X">W</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text">W</div>
          </div>
          <input type="number" name="dst_w" value="{{$thisImg->dst_w}}" class="form-control" id="W" placeholder="Destination width">
      </div>

          <label class="sr-only" for="X">H</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text">H</div>
          </div>
          <input type="number" name="dst_h" value="{{$thisImg->dst_h}}"class="form-control" id="H" placeholder="Destination height">
      </div>
      <button type="submit" class="btn btn-success btn-block">إختبار </button>

  </div>
</form>
</div>

<div class="col col-6  card-success mt-4 mb-4 text-center">
    <div class="card">
        <div class="card-header">
            <p>Image After Update Here</p>
        </div>
        <div class="card-body">
            <img class="img-responsive" src='/img/output/output.png'>
        </div>
    </div>
</div>
</div>


<!-- End Content -->

@endsection('content')


