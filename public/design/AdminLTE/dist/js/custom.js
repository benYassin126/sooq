$(document).ready(function(){
  $('.autoplay').slick({
  });
});

function validate(id) {

      if (document.getElementById('exampleCheck1_'+id).checked) {
          document.getElementById('multipPrices_'+id).style.display = 'block';
      } else {
           document.getElementById('multipPrices_'+id).style.display = 'none';
      }
    }

function ProdiectForm(id) {

  var L =  document.getElementById('ImgLPrice_'+id).value;
  var M =  document.getElementById('ImgMPrice_'+id).value;
  var S =  document.getElementById('ImgSPrice_'+id).value;
  var Stuts;

  if (L != '' && M != '' && S != '') {
    Stuts = 'true';
  }else {
    Stuts = 'false';
  }

      if (document.getElementById('exampleCheck1_'+id).checked && Stuts == 'false') {
      event.preventDefault();
      document.getElementById('ProdectAlert_'+id).style.display = 'block';

    }

    if (!document.getElementById('exampleCheck1_'+id).checked) {
   document.getElementById('ImgLPrice_'+id).value = '';
   document.getElementById('ImgMPrice_'+id).value = '';
   document.getElementById('ImgSPrice_'+id).value = '';

    }

    }

function showAllPrices (id) {
   var large = document.getElementById('ImgLPrice_'+id);
   var small = document.getElementById('ImgSPrice_'+id);

   if (large.value !== '' || small.value !== '' ) {
      document.getElementById('multipPrices_'+id).style.display = 'block';
      document.getElementById('exampleCheck1_'+id).checked = 'checked';
   }
}

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
$('#changeTemplateForm').one('submit', function() {
    $(this).find('input[type="submit"]').attr('disabled','disabled');
});
$("#changeTemplateForm,#tryForm").on("submit", function(){
    $("#pageloaderWhenDesign").fadeIn();
    $('.progress-bar').css('width', '95%');
        var typed = new Typed('#typed',{
        stringsElement: '#typed-strings',
        backSpeed: 30,
        typeSpeed: 90,
        shuffle: true,
        loop: true,
    });
  });//submit

$("#uploadImgsForm,#registerForm,#a3tmed,#addPrice").on("submit", function(){
    alert('f');
    $("#pageloader").fadeIn();
  });//submit



function CheckPhoneType(val){
 var inst = document.getElementById('inst');
 var tweet = document.getElementById('one');
 if(val=='one'){
   tweet.style.display='block';
   inst.style.display='none';
}
 else{
   inst.style.display='block';
   tweet.style.display='none';
}

}
