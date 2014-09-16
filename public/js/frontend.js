jQuery(function($) {
    $('#alert-message').on('click', '.js-hide-alert', function() {
        $(this).closest('#alert-message').trigger('hide');
    });

    $('#alert-message').on('hide', function() {
        $(this).addClass('hidden');
    });
});
