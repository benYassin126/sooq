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
        <h4 class="text-center mb-4">المنتجات</h4>
        <a href="{{ route('imgs.create') }}" class="btn btn-success btn-block mb-4">إضافة  منتجات</a>
        <form>
            @csrf
        </form>
        <a  onclick="return confirm('{{__('هل انت متاكد ؟')}}')"  href="{{ url('/home/imgs/deleteAllImgs') }}" class="btn btn-danger btn-block mb-4">حذف جميع المنتجات</a>
        <hr>
        <div class="allImg">
            <div class="row">
                @forelse($allImg as $img)
                <div class="col col-sm-12 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                                <img style="width: 100%; height: 200px;"  src="{{ url('/') }}/img/storage/imgs/{{$img->TheImg}}">
                        </div>
                        <div class="card-footer">
                            <button data-toggle="modal" data-target="#{{$img->id}}" onclick="showAllPrices({{$img->id}})" class="btn btn-block btn-info">معلومات المنتج</button>
                            <form method="Post" action="{{route('imgs.destroy',$img->id)}}" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button  onclick="return confirm('{{__('هل انت متاكد ؟')}}')"  class="btn btn-danger btn-block"><i class="fas fa-trash-alt"></i>  حذف  الصورة </buttn>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Edit Modal -->
                <div class="modal fade" id="{{$img->id}}"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="{{$img->id}}">معلومات المنتج</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="{{ route('imgs.update',$img->id) }}" method="post" >
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group ">
                                        <label  class="control-label ml-2">نوع الصورة  :</label>
                                        <input type="radio" name="ImgType" value="Transparent" id="Transparent_{{$img->id}}"  @if($img->ImgType == 'Transparent') checked @endif>
                                        <label class="ml-4" for="Transparent_{{$img->id}}">مغرغ</label>
                                        <input type="radio" name="ImgType" value="WithBackGound" id="WithBackGound_{{$img->id}}"  @if($img->ImgType == 'WithBackGound') checked @endif>
                                        <label for="WithBackGound_{{$img->id}}">بيئي</label>
                                    </div>
                                    <div class="form-group">
                                        <h6 class="control-label">اسم المنتج</h6>
                                        <div>
                                            <input value="{{$img->ImgName}}" class="form-control" type="text" name="ImgName" placeholder="مثلا : بيتزا خضار" >
                                        </div>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input @if($img->ShowName == 'yes') checked @endif type="checkbox" class="form-check-input" id="ShowName_{{$img->id}}" name="ShowName">
                                        <label class="form-check-label" for="ShowName_{{$img->id}}">إظهار اسم المنتج في التصميم  ؟</label>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label">نوع المنتج  : </label>
                                        <select  name="ImgSection" class="form-control">
                                            <option value="طبق رئيسي">طبق رئيسي</option>
                                            <option value="طبق جانبي" >طبق جانبي</option>
                                            <option value="مقبلات" >مقبلات</option>
                                            <option value="صوص" >صوص</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <h6  class="control-label">سعر المنتج</h6>
                                        <div>
                                            <input value="{{$img->ImgPrice}}" placeholder="0" name="ImgPrice" type="number" step="0.01" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;" />
                                        </div>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1_{{$img->id}}" onclick="validate({{$img->id}})">
                                        <label class="form-check-label" for="exampleCheck1_{{$img->id}}">منتج متعدد الأسعار ؟</label>
                                    </div>
                                    <div style="display: none;" id="ProdectAlert_{{$img->id}}" class="alert alert-danger">
                                        <p>يجب ادخال اسعار كل المقاسات</p>
                                    </div>
                                    <div class="form-group" style="display: none;" id="multipPrices_{{$img->id}}">
                                        <input id="ImgLPrice_{{$img->id}}" value="{{$img->ImgLPrice}}" name="ImgLPrice" class="mt-2"  step="0.01" placeholder="سعر الكبير" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;" />
                                        <input id="ImgMPrice_{{$img->id}}" value="{{$img->ImgMPrice}}" name="ImgMPrice" class="mt-2"  step="0.01" placeholder="سعر الوسط" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;" />
                                        <input id="ImgSPrice_{{$img->id}}" value="{{$img->ImgSPrice}}" name="ImgSPrice" class="mt-2"  step="0.01" placeholder="سعر الصغير" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;" />
                                    </div>
                                    <button onclick="ProdiectForm({{$img->id}})" type="submit" class="btn btn-success btn-block">حفظ </button>
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
