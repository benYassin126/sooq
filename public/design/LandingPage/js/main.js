function post()
{
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
  var msg = document.getElementById("msg").value;
  if(msg)
  {

    $.ajax
    ({
      type: 'post',
      url: '/try.submit',
      data:
      {
         Nots:msg,

      },
      success: function (response)
      {
      document.getElementById("status").innerHTML="شكراااا .. رسالتك وصلت .. باذن الله نتطلع للافضل";
    //  $("#colse").delay(5000).click();
      setTimeout(function(){
         $('#exampleModal2').modal('hide')
    }, 2000);
      }
    });
  }else {
    document.getElementById("status").innerHTML="الحقل مطلوب";
  }


  return false;
}


$('#myForm').one('submit', function() {
    $(this).find('input[type="submit"]').attr('disabled','disabled');
});



$('#form2').on('submit', function(e) {
  var inst = document.getElementById('inst').value;
 var tweet = document.getElementById('tweet').value;


 if (inst == '' && tweet == '') {
  $('#alert').fadeIn(500);
    e.preventDefault();
 }


});



function CheckBusinessType(val){
 var OtherBusinessTypeElement=document.getElementById('OtherBusinessType');
 if(val=='others'){
   OtherBusinessTypeElement.style.display='block';
   OtherBusinessTypeElement.setAttribute("required", "required");
}
 else{
   OtherBusinessTypeElement.style.display='none';
  OtherBusinessTypeElement.removeAttribute("required");
  OtherBusinessTypeElement.value = '';

    val ='';
}

}

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

function replaceColor(){

 var MineColor = document.getElementById('MineColor');
 var SubColor = document.getElementById('SubColor');
 let TempColor;
 TempColor = MineColor.value;

MineColor.value = SubColor.value;
SubColor.value = TempColor;

}


function defultColor(){

 var MineColor = document.getElementById('MineColor');
 var SubColor = document.getElementById('SubColor');
 var TempColor = SubColor.value;


    SubColor.value = "#010101";
MineColor.value =  "#010101";



}



(function($) {

  "use strict";

  $(window).on('load', function() {


  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
  })
})




















  /*Page Loader active
  ========================================================*/
  $('#preloader').fadeOut();

  // Sticky Nav
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 100) {
            $('.scrolling-navbar').addClass('top-nav-collapse');
        } else {
            $('.scrolling-navbar').removeClass('top-nav-collapse');
        }
    });

    /* Auto Close Responsive Navbar on Click
    ========================================================*/
    function close_toggle() {
        if ($(window).width() <= 768) {
            $('.navbar-collapse a').on('click', function () {
                $('.navbar-collapse').collapse('hide');
            });
        }
        else {
            $('.navbar .navbar-inverse a').off('click');
        }
    }
    close_toggle();
    $(window).resize(close_toggle);

    // one page navigation
    $('.navbar-nav').onePageNav({
      currentClass: 'active'
    });

    /* slicknav mobile menu active  */
    $('.mobile-menu').slicknav({
        prependTo: '.navbar-header',
        parentTag: 'liner',
        allowParentLinks: true,
        duplicate: true,
        label: '',
        closedSymbol: '<i class="lni-chevron-right"></i>',
        openedSymbol: '<i class="lni-chevron-down"></i>',
      });

      /* WOW Scroll Spy
    ========================================================*/
     var wow = new WOW({
      //disabled for mobile
        mobile: false
    });

    wow.init();

    /*

    /* Testimonials Carousel


    /* Back Top Link active
    ========================================================*/
      var offset = 200;
      var duration = 500;
      $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
          $('.back-to-top').fadeIn(400);
        } else {
          $('.back-to-top').fadeOut(400);
        }
      });

      $('.back-to-top').on('click',function(event) {
        event.preventDefault();
        $('html, body').animate({
          scrollTop: 0
        }, 600);
        return false;
      });

  });

}(jQuery));
