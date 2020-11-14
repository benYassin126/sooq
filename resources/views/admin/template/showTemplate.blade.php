@extends('admin.layouts.adminLTE')
@section('title','نظرة عامة')
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
    <div class="TemplateInfo">
      <table class="table table-bordered">
        <thead>
          <tr class="table-info">
            <th scope="col">اسم القالب</th>
            <th scope="col">شكل القالب</th>
            <th scope="col">التحكم بالقالب</th>
          </tr>
          <tr>
            <th>{{$thisTemplate->TemplateName}}</th>
            <th><img src="{{ url('/') }}/img/storage/templates/{{$thisTemplate->TemplateBackGroundName}}"style="width: 150px"></th>
            <th> <a href="{{ route('template.edit',$thisTemplate->id) }}" class="btn btn-primary mb-4 ">تعديل بيانات القالب</a></th>
          </tr>
        </thead>
      </table>
    </div>
    <a href="{{ route('templateImg.create') }}?TemplateID={{$thisTemplate->id}}" class="btn btn-success btn-block mb-4">إضافة  تصاميم القالب</a>
    <a href="{{ url('/admin/template')}}/{{$thisTemplate->id}}/useTemplate" class="btn btn-primary btn-block mb-4">استخدام القالب</a>
    <hr>
    <div class="allImg">
      <div class="row">
        @forelse($allImg as $img)
        <div class="col col-4">
          <div class="card">
            <div class="card-body">
              <img class="img-responsive" src="{{ url('/') }}/img/storage/template_imgs/{{$img->TheImg}}">
            </div>
            <div class="card-footer">
              <form  action="{{ route('templateImg.update',$img->id) }}" method="post" style="float: right;">
                @csrf
                @method('PATCH')
                <label>نوع البوست:</label>
                <div class="form-group">
                  <select class="form-control" name="ImgType">
                    <option value="Transparent" @if($img->ImgType == 'Transparent') selected @endif>أبيض</option>
                    <option value="WithBackGound" @if($img->ImgType == 'WithBackGound') selected @endif>بيئي</option>
                    <option value="Logo" @if($img->ImgType == 'Logo') selected @endif>شعار</option>
                    <option value="Social" @if($img->ImgType == 'Social') selected @endif>سوشال ميديا</option>
                  </select>
                </div>


                <input type="checkbox" name="Blurry" value="yes" id="Blurry_{{$img->id}}" @if($img->Blurry == 'yes') checked @endif>
                <label class="ml-2" for="Blurry_{{$img->id}}">تعتيق</label>
                <br>

                <button type="submit" class="btn btn-success ">حفظ </button>
              </form>


              <form method="Post" action="{{route('templateImg.destroy',$img->id)}}" style="float: left;">
                @csrf
                @method('DELETE')
                <button  onclick="return confirm('{{__('هل انت متاكد ؟')}}')"  class="btn btn-danger "><i class="fas fa-trash-alt"></i>  حذف  الصورة </buttn>
              </form>
            </div>
          </div>
        </div>
        @empty
        <p>لم تقم برفع تصاميم للقالب</p>
        @endforelse
      </div>
    </div>
    @endsection('content')
