$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
        alwaysShowClose: true,
        wrapping: false
    });
});
$(document).on('click', '.clickable-row', function() {
    window.location = $(this).data("href");
});

// ===== Scroll to Top ====
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});

$(document).ready(function(){
    // Get the slugs in the path as an array
    let path_names = window.location.pathname.split("/");
    // If the last slug is numeric and the first slug is classmate, we can manipulate the contact form.
    if(path_names[1] === 'classmate' && !isNaN(parseInt(path_names[path_names.length-1])) && document.getElementById("contact") !== null){
        $('#contact #contact_classmate').parent().remove();
        $('#contact').prepend('<input type="hidden" name="contact[classmate]" value="' + parseInt(path_names[path_names.length-1]) + '" />')
        console.log(true);
    }
});