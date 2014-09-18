var FluxBB = {
	ajax: function(method, path, data, onSuccess) {
		path = '/' + path;

		return $.ajax({
			type: method,
			url: path,
			data: data
		}).success(onSuccess);
	},

    alert: function(message) {
        var $alert = $('#alert-message p').text(message);
        $alert.trigger('show');

        setTimeout(function () {
            $alert.trigger('hide');
        }, 5000);
    }
};
