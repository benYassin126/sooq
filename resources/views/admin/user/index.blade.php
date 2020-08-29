@extends('admin.layouts.adminLTE')
@section('title','العملاء')
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
<div class="row">
    <div class="card mt-4 text-center">
        <div class="card-header">

        <form action="{{route('user.search')}}" method="post" onsubmit="return false">
            @csrf
            <input class="form-control form-control"  id="search" name="search" type="search" placeholder="بحث عن عميل" aria-label="Search" >
        </form>



        <a href="{{route('user.create')}}" class="btn btn-success btn-block mt-4"><i class="fas fa-user"></i> اضافة عميل  </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive-sm">
      <table class="table  table-bordered table-striped">
        <thead>
            <tr>
              <th>#</th>
              <th>اسم العميل</th>
              <th>نشاط العميل</th>
              <th>نوع الباقة</th>
              <th>المتبقي على الاشتراك</th>
              <th>حالة العميل</th>
              <th>تحكم</th>
          </tr>
      </thead>
      <tbody>

        @forelse($allUsers as $kay=>$user)

        <tr>
            <td>{{$kay+1}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->BusinessType}}</td>
            <td>{{isset($user->Subscrip) ? $user->Subscrip->PakageName : 'لم يشترك'}}</td>
            <td>-</td>
            <td>{{$user->Append == 1 ? "مغعل" : "محظور"}}</td>
            <td>

                <a href="{{route('user.edit',$user->id) }}" class="btn btn-info "><i class="fas fa-edit"></i></a>


                <form method="post" action="{{route('user.destroy',$user->id)}}" style="display: inline-block;">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('{{__('هل انت متاكد ؟')}}')" class="btn btn-danger "><i class="fas fa-trash-alt"></i></buttn>
                  </form>

            </td>
        </tr>

@empty
    <div class="alert alert-danger  fade show" role="alert">
     <h4>ليس هناك اي عملاء حتى الان</h4>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
       <a href="{{route('user.create')}}" class="btn btn-info mb-4"><i class="fas fa-plus"></i> اضافة عميل </a>

@endforelse
</tbody>
<tfoot>

</tfoot>
</table>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

@endsection('content')




