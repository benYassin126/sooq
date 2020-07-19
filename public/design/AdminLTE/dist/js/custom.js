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

$("#changeTemplateForm").on("submit", function(){
    $("#pageloader").fadeIn();
  });//submit



function CheckPhoneType(val){
 var inst = document.getElementById('inst');
 var tweet = document.getElementById('tweet');
 if(val=='tweet'){
   tweet.style.display='block';
   inst.style.display='none';
}
 else{
   inst.style.display='block';
   tweet.style.display='none';
}

}
