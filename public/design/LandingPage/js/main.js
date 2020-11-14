$(".MainecolorPickSelector").colorPick({
    'initialColor':'#010101',
  'onColorSelected': function() {
    this.element.css({'backgroundColor': this.color, 'color': this.color});
    $('#MineColor').val(this.color);
  }
});

$(".SubcolorPickSelector").colorPick({
  'onColorSelected': function() {
    this.element.css({'backgroundColor': this.color, 'color': this.color});
    $('#SubColor').val(this.color);
  }
});

$(".fileUpload").on("change", ".uploadBtn", function () {
        $(this).siblings(".fileName").text($(this).val().replace(/C:\\fakepath\\/i, ''));
});

$('.MinePalateButton').click(function(){
    $('#MineColorPalete').toggle('3000');
})

$('.SubPalateButton').click(function(){
    $('#SubColorPalete').toggle('3000');
})

//valdite max file for images
$("#Transparent,#WithBackGound").on("change", function() {
    if ( $("#WithBackGound")[0].files.length > 15) {
        alert("العدد  المسموح به 6 صور فقط");
    }

});
function goBack() {
  alert(document.referrer);
  window.history.back();
}

//Function to send form without refresh page
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
      document.getElementById("status").innerHTML="طلبك وصل بإذن الله التصميم الجاي بحاول يكون زي ماتبي";
    //  $("#colse").delay(5000).click();
      setTimeout(function(){
         $('#exampleModal2').modal('hide')
    }, 5000);
      }
    });
  }else {
    document.getElementById("status").innerHTML="الحقل مطلوب";
  }


  return false;
}


//make value of inpue equal pic

function picMineFun() {

 var MineColor = document.getElementById('MineColor');
 var PicMineColor = document.getElementById('PicMineColor').value;
 MineColor.value = PicMineColor;
}

function picSubeFun() {

 var SubColor = document.getElementById('SubColor');
 var PicSubColor = document.getElementById('PicSubColor').value;

 SubColor.value = PicSubColor;
}

function selectSubFun(color) {
 var SubColor = document.getElementById('SubColor');
 SubColor.value = color;
}

function selectMineFun(color) {
 var MineColor = document.getElementById('MineColor');
 MineColor.value = color;
}


//Hidde Submit Form After Send data

$('#changeTemplateForm').one('submit', function() {
    $(this).find('input[type="submit"]').attr('disabled','disabled');
});


$('#ColorsForm').on("submit",function(){

  var MineColor = document.getElementById('MineColor');
  var SubColor = document.getElementById('SubColor');
  var Coloralert = document.getElementById('Coloralert');

   if (MineColor.value == '#010101' || SubColor.value == '#010101') {
    event.preventDefault();
    Coloralert.style.display='block';
   }else
   {
     $("#pageloaderWhenDesign").fadeIn();
     $('.progress-bar').css('width', '95%');
     var typed = new Typed('#typed',{
                    stringsElement: '#typed-strings',
                    backSpeed: 30,
                    typeSpeed: 90,
                     shuffle: true,
                    loop: true,
                  });
   }
})

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

$("#uploadImgsForm,#registerForm,#a3tmed").on("submit", function(){
    $("#pageloader").fadeIn();
  });//submit



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
 var PicMineColor = document.getElementById('PicMineColor');
 var PicSubColor = document.getElementById('PicSubColor');
 let TempColor;

TempColor = MineColor.value;

MineColor.value = SubColor.value;
SubColor.value = TempColor;

 var MineColor = document.getElementById('MineColor');
 var SubColor = document.getElementById('SubColor');
 TempColor = MineColor.value;

PicMineColor.value = TempColor;
PicSubColor.value = SubColor.value;

}



$(function(){
  $('.fa-minus,.chatbox-top,.a3tmed').click(function(){ $('.fa-minus').closest('.chatbox').toggleClass('chatbox-min');
  });
});

$(function() {

    "use strict";

    //===== Prealoder

    $(window).on('load', function(event) {
        $('.preloader').delay(500).fadeOut(500);
    });


    //===== Mobile Menu

    $(".navbar-toggler").on('click', function() {
        $(this).toggleClass('active');
    });

    $(".navbar-nav a").on('click', function() {
        $(".navbar-toggler").removeClass('active');
    });


    //===== close navbar-collapse when a  clicked

    $(".navbar-nav a").on('click', function () {
        $(".navbar-collapse").removeClass("show");
    });


    //===== Sticky

    $(window).on('scroll',function(event) {
        var scroll = $(window).scrollTop();
        if (scroll < 10) {
            $(".navigation-bar").removeClass("sticky");
        }else{
            $(".navigation-bar").addClass("sticky");
        }
    });




    //===== wow

    new WOW().init();


    //===== AOS

     AOS.init({
         duration: 800,
     });


    //===== Slick project

    $('.project-active').slick({
        dots: true,
        infinite: true,
        speed: 800,
        slidesToShow: 5,
        slidesToScroll: 3,
        arrows: false,
        responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 4,
              }
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 3,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              }
            },
            {
              breakpoint: 576,
              settings: {
                slidesToShow: 1,
              }
            }
        ]
    });


    //===== Slick Testimonial

    $('.testimonial-active').slick({
        dots: true,
        infinite: true,
        speed: 800,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
    });


    //===== Back to top

    // Show or hide the sticky footer button
    $(window).on('scroll', function(event) {
        if($(this).scrollTop() > 600){
            $('.back-to-top').fadeIn(200)
        } else{
            $('.back-to-top').fadeOut(200)
        }
    });

    //Animate the scroll to yop
    $('.back-to-top').on('click', function(event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: 0,
        }, 1500);
    });








});
