
<div class="container">
    <div class="row justify-content-center">

 <div class="allImg">
      <div class="row">

        @forelse($allUserDesigns as $img)
        <div class="col col-sm-12 col-md-6 col-lg-3">
          <div class="card mb-2">
            <div class="card-body">
              <img style="width: 200px; height: 200px;" src="{{ url('home/fetch_image') }}/{{$img->id}}">
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

