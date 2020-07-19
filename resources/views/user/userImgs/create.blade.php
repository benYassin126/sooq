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
                    <h3 class="card-title">تفضل برفع   الصور</h3>
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
        <!-- End Content -->
        @endsection('content')
