
@csrf
<div class="card-body">
  <div class="form-group">
    <label class="control-label">اسم  القالب</label>
    <div>
      <input type="text" class="form-control"  placeholder="اسم  القالب"  autofocus name="TemplateName"  @isset($thisTemplate) value="{{$thisTemplate->TemplateName}}" @endisset required >
  </div>
</div>

  <div class="form-group">
    <label class="control-label">مظهر القالب</label>
    <div>
     <input type="file" name="TemplateBackGround" />
  </div>
</div>

<div class="form-group">
    <label class="control-label">لون القالب الأساسي  (Hex)</label> <span style="color: red">اجباري</span>
    <div>
     <input type="color" name="MineColor"{{isset($thisTemplate) ? 'value=' . $thisTemplate->MineColor .'': 'value=#010101'}} >
  </div>
</div>

  <div class="form-group">
    <label class="control-label">لون القالب الثانوي  (Hex)</label> <span style="color: green">اختياري</span>
    <div>
     <input type="color" name="SubColor" {{isset($thisTemplate) ? 'value=' . $thisTemplate->SubColor .'' : 'value=#010101'}}>
  </div>
</div>

  <div class="form-group">
    <label class="control-label">لون القالب الثانوي الاضافي  (Hex)</label>  <span style="color: green">اختياري</span>
    <div>
     <input type="color" name="SubSubColor"{{isset($thisTemplate) ? 'value=' . $thisTemplate->SubSubColor .'' : 'value=#010101'}}>
  </div>
</div>

</div>


