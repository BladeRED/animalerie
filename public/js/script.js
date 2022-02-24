

    // SMOOTH SLIDE DROPDOWN-MENU 

    $('.dropdown-menu').addClass('invisible'); //FIRST TIME INVISIBLE

// ADD SLIDEDOWN ANIMATION TO DROPDOWN-MENU 
  $('.dropdown').on('show.bs.dropdown', function(e){
    $('.dropdown-menu').removeClass('invisible');
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  });

  // ADD SLIDEUP ANIMATION TO DROPDOWN-MENU 
  $('.dropdown').on('hide.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
  });


// Pop up
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}

