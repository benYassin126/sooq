@extends('user.layouts.userLTE')
@section('title','لوحة التجكم')
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
        @if(session()->has('erorr'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="display-success">
            <strong>{{ session()->get('erorr') }}</strong>
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
        <h4 class="text-center mb-4">اضافة نصوص للتصاميم</h4>
        <hr>
        <div class="allImg">
            <div class="row">
                @forelse($allImg as $img)
                <div class="col col-sm-12 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <img style="width: 100%; height: 200px;" src="{{ url('/home/text/fetch_image') }}/{{$img->id}}">
                        </div>
                        <div class="card-footer">
                            @if(!file_exists('./img/before/' . auth::id() . '/'. $img->id .'.png'))
                            <button data-toggle="modal" data-target="#{{$img->id}}" class="btn btn-block btn-success">اضافة نص</button>
                            @else
                            <button data-toggle="modal" data-target="#{{$img->id * 2}}" class="btn btn-block btn-info">تعديل النص</button>
                            <form action="{{ url('/text/delete') }}" method="post" class="mt-2">
                                @csrf
                                <input type="hidden" name="id" value="{{$img->id}}">
                                <button class="btn btn-block btn-danger">حذف النص</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <!--Add Modal -->
                <div class="modal fade" id="{{$img->id}}"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">اضاقة نص للصورة</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form  action="{{ url('/text/add') }}" method="Post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$img->id}}">
                                    <div class="form-group">
                                        <label class="control-label ml-2">النص</label>
                                        <input type="text" class="form-control" name="text" required autofocus maxlength="20">
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label class="control-label ml-2">السعر</label>
                                        <input type="number" class="form-control" name="price">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label ml-2">اللون</label>
                                        <input type="color" name="color" value="#000">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block"> حفظ</button>
                                </form>
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                        </div>
                    </div>
                </div>
                <!-- Edit Modal -->
                <div class="modal fade" id="{{$img->id * 2 }}"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">اضاقة نص للصورة</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form  action="{{ url('/text/edit') }}" method="Post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$img->id}}">
                                    <div class="form-group">
                                        <label class="control-label ml-2">النص</label>
                                        <input type="text" class="form-control" name="text" required autofocus maxlength="20">
                                    </div>
                                    <div class="form-group"  style="display: none;">
                                        <label class="control-label ml-2">السعر</label>
                                        <input type="number" class="form-control" name="price" >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label ml-2">اللون</label>
                                        <input type="color" name="color" value="#000">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block"> حفظ</button>
                                </form>
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                        </div>
                    </div>
                </div>
                @empty
                <p>مكتبة الصور فارغة</p>
                @endforelse
            </div>
        </div>
    </div>
    @endsection('content')
