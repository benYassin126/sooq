@extends('user.layouts.userLTE')
@section('title','رفع الصور')
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
                    <h3 class="card-title float-right">تفضل برفع   الصور</h3>
                    <button type="button" class="btn btn-secondary float-left" data-toggle="modal" data-target="#explaneModal">مثال للصور المفرغة والبيئية</button>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('imgs.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label ml-2">الصور المفرغة</label><br>
                            <p class="control-label ml-2">اذا كنت لا تملك صور مفرغة إليك هذه الأداة الرائعة</label><a target="_blank" href="https://www.remove.bg"><span class="right badge badge-danger">اضغط هنا لتفريغ الصور</p></a>
                            <div>
                                <input type="file" name="Transparent[]"   multiple="multiple" />
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="control-label ml-2">الصور البيئية</label>
                            <div>
                                <input type="file" name="WithBackGound[]"   multiple="multiple"  />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                        <button type="submit" class="btn btn-success btn-block">حفظ   الصور</button>
                    </div>
                </form>
            </div>
        </div>




<div class="modal fade" id="explaneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">وش أقصد بالصور المفرغة والبيئية ؟</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col col-sm-6" style="border-left: 1px solid hsla(230,7%,84%,1)">
            <h4>الصور المفرغة</h4>
            <img style="width: 280px;height: 200px;" src="/img/trans.png">
            <p  style="color: red">لاحظت ان الصورة مالها خلفية ؟</p>
            <hr>
          </div>

          <div class="col col-sm-6">
            <h4>الصور  البيئية</h4>
            <img style="width: 250px;height: 200px;" src="/img/back.jpg">
            <p style="color: red"> لاحظ معي ان الصورة لها خلفية</p>
            <hr>
          </div>
        </div>
      </div>
      <div class="modal-footer">
 <a  target="_blank"  href="https://www.remove.bg" class="btn btn-success ml-2" >اداة تفريغ الصور</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">تمام .. فهمت عليك</button>
      </div>
    </div>
  </div>
</div>
        <!-- End Content -->
        @endsection('content')
