$(document).ready(function() {
	$('#board-info p').click(function() {
		$(this).parent().addClass('edit');
		$('#board-info p').each(function(index, element) {
			$(element).next().val(element.innerHTML);
		});
		$(this).next().focus();
	});

	$('#board-info input.submit').click(function() {
		$('#board-info p').each(function(index, element) {
			element.innerHTML = $(element).next().val();
		});
		$(this).parent().removeClass('edit');

		$.ajax({
			type: "POST",
			url: baseUrl + "/admin/ajax/board_config",
			data: {
				board_title: $('#board-info input.title').val(),
				board_description: $('#board-info input.description').val()
			}
		}).done(function(data) {
			alert('saved');
		});
	});

	$(document).on('change', '[data-behavior=save-on-change]', function() {
        var $field = $(this);
        var name = $field.attr('name');
        var value = $field.val();

        $field.closest('.setting').trigger('changed', [name, value]);
    });

    $(document).on('changed', '.setting', function(event, name, value) {
        var $setting = $(this);
        var old = $setting.data('old');

        $setting.removeClass('saved');

        if (old !== value) {
            $.ajax({
                type: 'POST',
                url: '/admin/settings/' + name,
                data: {
                    value: value
                }
            }).success(function(data) {
                $setting.data('old', value);
                $setting.addClass('saved');
            });
        }
    });
});
