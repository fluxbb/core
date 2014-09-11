jQuery(function($) {
    $('.setting .js-save-on-change').each(function () {
        var $field = $(this);
        $field.closest('.setting').data('old', $field.val());
    });

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
            }).fail(function () {
                $setting.trigger('failed', [old]);
            }).always(function() {
                $setting.removeClass('saving');
            });
        }
    });

    $(document).on('failed', '.setting', function(event, oldValue) {
        var $field = $(this).find('.js-save-on-change');
        $field.val(oldValue);
    });
});
