jQuery(function($) {
	$(document).on('change', '.js-save-on-change', function() {
        var $field = $(this);
        var name = $field.attr('name');
        var value = $field.val();

        $field.closest('.setting').trigger('changed', [name, value]);
    });

    $(document).on('changed', '.setting', function(event, name, value) {
        var $setting = $(this);
        var old = $setting.data('old');

        $setting.removeClass('saved').addClass('saving');

        if (old !== value) {
            FluxBB.ajax('POST', 'admin/settings/' + name, {
                value: value
            }).success(function(data) {
                $setting.data('old', value);
                $setting.addClass('saved');
            }).always(function() {
                $setting.removeClass('saving');
            });
        }
    });
});
