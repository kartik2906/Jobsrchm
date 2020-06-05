$(document).ready(function () {
  var navoffset = $("nav").offset().top;

  $(window).scroll(function () {
    var scrollpos = $(window).scrollTop();

    if (scrollpos >= navoffset) {
      $("nav").addClass("fixed");
    } else {
      $("nav").removeClass("fixed");
    }

    if ($(window).scrollTop()) {
      $("#mainNav").css({
        "background-color": "#3B3561",
      });
    } else {
      $("#mainNav").css({
        "background-color": "transparent",
      });
    }
  });

  $("#location").change(function () {
    let loc = $(this).val();
    $.ajax({
      url: "/Jobsrchm/app/Home/locationRequest",
      type: "POST",
      data: {
        loc: loc,
      },
      datatype: "json",
      success: function (data) {
        let location = JSON.parse(data);
        let html = "";
        location.forEach(function (value) {
          html += `    <div class="card">
            <div class="card-header">
             ${value.jobtype}
    
            </div>
            <div class="card-body">
              <h5 class="card-title"></h5>
              <p class="card-text">${value.location}</p>
              <p class="card-text"> </p>
              <a href='/Jobsrchm/app/Home/viewMore?id=${value.recruiterid}' class="btn btn-primary">view more</a>
            </div>
          </div>`;
        });
        $("#result").html(html);
      },
    });
  });




  // $(document).ready(function () {
  //   $("#savebtn").click(function () {
  //     $("#saveform").submit(function () {

  //     }); // Submit the form
  //   });

  // });


});