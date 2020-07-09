function CheckBusinessType(val){
 var OtherBusinessTypeElement=document.getElementById('OtherBusinessType');
 if(val=='others'){
   OtherBusinessTypeElement.style.display='block';
   OtherBusinessTypeElement.setAttribute("required", "required");
}
 else{
   OtherBusinessTypeElement.style.display='none';
    val ='';
}

}
