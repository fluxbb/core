jQuery(function($) {
    var $alert = $('#alert-message');

    $alert.on('click', '.js-hide-alert', function(event) {
        event.preventDefault();
        $(this).closest('#alert-message').trigger('hide');
    });

    $alert.on('show', function() {
        $(this).removeClass('hidden');
    });

    $alert.on('hide', function() {
        $(this).addClass('hidden');
    });
});
