@extends('user.layouts.userLTE')
@section('title','الملف الشخصي')
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
    <!-- Strat MSG -->
    <br>
    <div class="card card-info mt-4 mb-4">
      <div class="card-header">
        <h3 class="card-title" style="display: inline-block;">ملفك الشخصي</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('profile') }}" method="post" enctype="multipart/form-data">
          @csrf
  <div class="form-group">
    <label class="control-label">اسم   الكريم</label>
    <div>
      <input type="text" class="form-control"  placeholder="اسمك"  autofocus name="name"  @isset($user) value="{{$user->name}}" @endisset required >
  </div>
</div>

<div class="form-group">
    <label class="control-label">ايميلك</label>
    <div>
      <input type="email" class="form-control"  placeholder="الايميل"   name="email"  @isset($user) value="{{$user->email}}" @endisset required >
  </div>
</div>

<div class="form-group">
    <label class="control-label">الرقم السري</label>
    <div>
      <input type="password" class="form-control"   name="password" >
  </div>
</div>

<div class="form-group">
    <label class="control-label">حسابك في تويتر</label>
    <div>
      <input type="text" class="form-control"  placeholder="Twitter"   name="Twitter"  @isset($user) value="{{$user->Twitter}}" @endisset  >
  </div>
</div>


<div class="form-group">
    <label class="control-label">حسابك في الانستقرام</label>
    <div>
      <input type="text" class="form-control"  placeholder="Instagram"   name="Instagram"  @isset($user) value="{{$user->Instagram}}" @endisset  >
  </div>
</div>

<div class="form-group">
    <label class="control-label">لون الهوية الاساسي  (Hex)</label>
    <div>
       <input type="color" name="MineColor"{{isset($user) ? 'value=' . $user->MineColor .'': 'value=#010101'}} >
   </div>
</div>


<div class="form-group mb-2">
    <label class="control-label ">لون الهوية الثانوي (Hex)</label>
    <div>
       <input type="color" name="SubColor" {{isset($user) ? 'value=' . $user->SubColor .'' : 'value=#010101'}}>
   </div>
</div>

        </div>
        <div class="card-footer">
          <button type="submit" name="update" class="btn btn-success btn-block"> <i class="fas fa-edit fa-sm"></i> حفظ التعديلات  </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection('content')
