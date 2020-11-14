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
        <h4 class="text-center mb-4"> جدول تصميمك وازهل الباقي علينا</h4>
        <hr>
        <div class="card card-info mt-4 mb-4" style="height: 65%;margin:0 auto;">
            <div class="card-header">
                <h3 class="card-title" style="display: inline-block;">جدولة التصميم</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('publish') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label"><i class="fab fa-instagram"></i> حسابك على الانستقرام</label>
                        <div>
                            <input type="text" class="form-control"  placeholder="حساب المنشأة على الانستقرام"  autofocus name="userAccount" required >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><i class="fab fa-instagram"></i> الرقم السري للحساب</label>
                        <div>
                            <input type="text" class="form-control" placeholder="الرقم السري لحساب المنشأة في الانستقرام" name="PasswordAccount" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ملاحظات النشر</label>
                        <div>
                            <textarea name="userNots"  class="form-control" placeholder="هل لديك اي ملاحظات بخصوص النشر .؟"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block"> <i class="fab fa-instagram"></i> نشر  </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')
