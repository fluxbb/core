jQuery(function($) {
    $('.setting .js-save-on-change').each(function () {
        var $field = $(this);
        $field.closest('.setting').data('old', $field.val());
    });

	$(document).on('change', '.js-save-on-change', function() {
        var $field = $(this);
        var name = $field.attr('name');
        var value = $field.val();

        // Checkboxes need a little bit of extra treatment
        if ($field.is(':checkbox')) {
            if (value == '1') {
                value = $field.is(':checked') ? 1 : 0;
            } else {
                value = $field.is(':checked') ? value : '';
            }
        }

        $field.closest('.setting').trigger('changed', [name, value]);
    });

    $(document).on('changed', '.setting', function(event, name, value) {
        var $setting = $(this);
        var old = $setting.data('old');

        $setting.removeClass('saved').addClass('saving');

        if (old !== value) {
            var data = {};
            data[name] = value;

            FluxBB.ajax('POST', 'api/v1/settings', data, function() {
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
