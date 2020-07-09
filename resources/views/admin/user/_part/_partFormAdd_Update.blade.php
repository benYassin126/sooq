
@csrf
<div class="card-body">
  <div class="form-group">
    <label class="control-label">اسم   العميل</label>
    <div>
      <input type="text" class="form-control"  placeholder="اسم   العميل"  autofocus name="name"  @isset($thisUser) value="{{$thisUser->name}}" @endisset required >
  </div>
</div>

<div class="form-group">
    <label class="control-label">ايميل العميل</label>
    <div>
      <input type="email" class="form-control"  placeholder="ايميل العميل"   name="email"  @isset($thisUser) value="{{$thisUser->email}}" @endisset required >
  </div>
</div>


<div class="form-group">
    <label class="control-label">الرقم السري</label>
    <div>
      <input type="password" class="form-control"  placeholder="الرقم السري لحساب العميل"   name="password" >
  </div>
</div>


<div class="form-group">
    <label class="control-label">رصيد العميل</label>
    <div>
      <input type="text" class="form-control"  placeholder="رصيد العميل"   name="Balance"  @isset($thisUser) value="{{$thisUser->Balance}}" @else value="0" @endisset  >
  </div>
</div>


<div class="form-group">
    <label class="control-label">حساب العميل في تويتر</label>
    <div>
      <input type="text" class="form-control"  placeholder="Twitter"   name="Twitter"  @isset($thisUser) value="{{$thisUser->Twitter}}" @endisset  >
  </div>
</div>


<div class="form-group">
    <label class="control-label">حساب العميل في الانستقرام</label>
    <div>
      <input type="text" class="form-control"  placeholder="Instagram"   name="Instagram"  @isset($thisUser) value="{{$thisUser->Instagram}}" @endisset  >
  </div>
</div>


<div class="form-group">
    <label class="control-label">نشاط العميل</label>
      <select name="BusinessType" onchange='CheckBusinessType(this.value);'>
        <option></option>
        <option {{ isset($thisUser) && $thisUser->BusinessType == 'مطعم' ? 'selected' : ''}}  value="مطعم">مطعم</option>
        <option {{ isset($thisUser) && $thisUser->BusinessType == 'تموينات غذائية' ? 'selected' : ''}} value="تموينات غذائية">تموينات غذائية</option>
        <option value="others">اخرى</option>
    </select>
     <input  type="text" name="OtherBusinessType" id="OtherBusinessType" style='display:none;'/>
</div>



<div class="form-group">
    <label class="control-label">شعار العميل</label>
    <div>
       <input type="file" name="Logo" />
   </div>
</div>

<div class="form-group">
    <label class="control-label">هوية العميل اللون الأول  (Hex)</label>
    <div>
       <input type="color" name="MineColor"{{isset($thisUser) ? 'value=' . $thisUser->MineColor .'': 'value=#010101'}} >
   </div>
</div>

<div class="form-group">
    <label class="control-label">هوية العميل اللون الثاني (Hex)</label>
    <div>
       <input type="color" name="SubColor" {{isset($thisUser) ? 'value=' . $thisUser->SubColor .'' : 'value=#010101'}}>
   </div>
</div>

<div class="form-group">
    <label class="control-label">حالة العميل</label>
    <input type="radio" name="Append" value="1" id="1" checked>
     <label class="ml-4" for="1">مفعل</label>


  <input type="radio" name="Append" value="0" id="0">
  <label for="0">محظور</label>
</div>



</div>


