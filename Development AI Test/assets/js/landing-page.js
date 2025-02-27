jQuery(document).ready(function($) {
    // Show/hide registration form
    $('.register-button').on('click', function(e) {
        e.preventDefault();
        $('.registration-form').fadeIn();
    });

    // Close form when clicking outside
    $('.registration-form').on('click', function(e) {
        if ($(e.target).hasClass('registration-form')) {
            $(this).fadeOut();
        }
    });
}); 