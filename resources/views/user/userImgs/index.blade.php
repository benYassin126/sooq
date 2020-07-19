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
        <h4 class="text-center mb-4">مكتبة الصور</h4>


            <a href="{{ route('imgs.create') }}" class="btn btn-success btn-block mb-4">إضافة صور</a>
            <form>
                @csrf
            </form>
    <a  onclick="return confirm('{{__('هل انت متاكد ؟')}}')"  href="{{ url('/home/imgs/deleteAllImgs') }}" class="btn btn-danger btn-block mb-4">حذف جميع الصور</a>
    <hr>
    <div class="allImg">
      <div class="row">

        @forelse($allImg as $img)
        <div class="col col-6">
          <div class="card">
            <div class="card-body text-center">
               <img style="width: 200px; height: 200px;" src="{{ url('/home/imgs/fetch_image') }}/{{$img->id}}">
            </div>
            <div class="card-footer">
              <form  action="{{ route('imgs.update',$img->id) }}" method="post" style="float: right;">
                @csrf
                @method('PATCH')
                <input type="radio" name="ImgType" value="Transparent" id="Transparent_{{$img->id}}"  @if($img->ImgType == 'Transparent') checked @endif>
                <label class="ml-4" for="Transparent_{{$img->id}}">مغرغ</label>
                <input type="radio" name="ImgType" value="WithBackGound" id="WithBackGound_{{$img->id}}"  @if($img->ImgType == 'WithBackGound') checked @endif>
                <label for="WithBackGound_{{$img->id}}">بيئي</label>
                <button type="submit" class="btn btn-success ">حفظ </button>
              </form>
              <form method="Post" action="{{route('imgs.destroy',$img->id)}}" style="float: left;">
                @csrf
                @method('DELETE')
                <button  onclick="return confirm('{{__('هل انت متاكد ؟')}}')"  class="btn btn-danger "><i class="fas fa-trash-alt"></i>  حذف  الصورة </buttn>
              </form>
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
