@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      @if (isset($newUser))
         <h3>تم ارسال الايميل</h3>
         <br>
      @endif
        <h1>Home.Blade</h1>
 <div class="allImg">
      <div class="row">

        @forelse($allUserDesigns as $img)
        <div class="col col-sm-12 col-md-6 col-lg-3">
          <div class="card mb-2">
            <div class="card-body">
              <img style="width: 200px; height: 200px;" src="{{ url('home/fetch_image') }}/{{$img->id}}">
            </div>
            <div class="card-footer">
              <form method="Post" action="{{route('templateImg.destroy',$img->id)}}">
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
    </div>
</div>
@endsection
