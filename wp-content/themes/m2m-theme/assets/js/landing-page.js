jQuery(document).ready(function($) {
    const registerButton = $('.register-button');
    const formContainer = $('.form-container');

    registerButton.on('click', function(e) {
        e.preventDefault();
        
        // Smooth scroll to the form area
        $('html, body').animate({
            scrollTop: $('#registration-form').offset().top - 50
        }, 1000, function() {
            // After scrolling, show the form with animation
            formContainer.addClass('visible');
        });
    });

    // For debugging
    console.log('M2M Landing page script loaded');
}); 