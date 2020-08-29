@extends('admin.layouts.adminLTE')
@section('title','القوالب')
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
    <h4 class="text-center mb-4">احصائيات روّج</h4>
    <br>
    <div class="row">
      <div class="col-lg-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$CountOfUsers}}</h3>
            <p>العملاء</p>
          </div>
          <div class="icon">
            <i class="ionicons ion-android-person"></i>
          </div>
          <a href="{{ url('/admin/user') }}" class="small-box-footer">قائمة العملاء <i class="fa fa-arrow-circle-left"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-6 ">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$CountOfImgs}}</h3>
            <p>الصور في النظام</p>
          </div>
          <div class="icon">
            <i class="ionicons ion-person-stalker"></i>
          </div>
          <a href="{{ route('allImages') }}" class="small-box-footer">مشاهدة الصور <i class="fa fa-arrow-circle-left"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <br>
     <h4 class="text-center mb-4">اختبار A/B Testing</h4>

      <table class="table  table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>الاختبار</th>
            <th>العدد / النسبة</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>0</td>
            <td>عدد مرات التجارب حتى الآن</td>
            <td>150</td>
          </tr>
          <tr>
            <td>1</td>
            <td>المستخدمين الذين جربوا النموذج A</td>
            <td>50</td>
          </tr>
          <tr>
            <td>2</td>
            <td>المستخدمين الذين جربوا النموذج B</td>
            <td>90</td>
          </tr>
          <tr>
            <td>3</td>
            <td>المستخدمين الذين اتموا عملية التسجل من النموذج A</td>
            <td>20</td>
          </tr>
          <tr>
            <td>4</td>
            <td>المستخدمين الذين اتموا عملية التسجل من النموذج B</td>
            <td>10</td>
          </tr>
          <tr>
            <td>5</td>
            <td>نسبة اكمال التسجيل للنموذج A</td>
            <td>50%</td>
          </tr>
          <tr>
            <td>6</td>
            <td>نسبة اكمال التسجيل للنموذج B</td>
            <td>40%</td>
          </tr>
        </tbody>
        <tfoot>
        </tfoot>
      </table>
    </div>
    <br>
    <h4 class="text-center mb-4">النشاطات</h4>
    <div class="card-body table-responsive-sm">
      <table class="table  table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>النشاط</th>
            <th>عدد اصحاب النشاط</th>
          </tr>
        </thead>
        <tbody>
          @foreach($BusinessTypeTotal as $kay=>$Business)
          <tr>
            <td>{{$kay+1}}</td>
            <td>{{$Business->BusinessType}}</td>
            <td>{{$Business->total}}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- Main row -->
  <br>
  <h4 class="text-center mb-4">الملاحظات</h4>
  <div class="card-body table-responsive-sm">
    <table class="table  table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>الملاحظة</th>
          <th>رقم الجوال</th>
        </tr>
      </thead>
      <tbody>
        @foreach($Nots as $kay=>$nots)
        <tr>
          <td>{{$kay+1}}</td>
          <td>{{$nots->Nots}}</td>
          <td>{{$nots->PhoneNumber}}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </div>
  <!-- /.card-body -->
</div>
</div>
<!-- End Content -->
@endsection('content')
