var FluxBB = {
	ajax: function(method, path, data) {
		path = '/' + path;

		return $.ajax({
			type: method,
			url: path,
			data: data
		});
	},

    alert: function(message) {
        var $alert = $('#alert-message').html('').removeClass('hidden');
        $('<p />').text(message).appendTo($alert);

        setTimeout(function () {
            $alert.trigger('hide');
        }, 5000);
    }
};
