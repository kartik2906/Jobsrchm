  $(document).ready(function(){

    var navoffset = $("nav").offset().top;

    $(window).scroll(function(){
      var scrollpos = $(window).scrollTop();

        if (scrollpos >=  navoffset) {
          $("nav").addClass("fixed");

        }else{
          $("nav").removeClass("fixed");

        }

        if ($(window).scrollTop()) {
          $("#mainNav").css({
            "background-color": '#3B3561'
          });
        }else{
          $("#mainNav").css({
            "background-color": 'transparent'
          });
        }

    });


  })
 
