var FluxBB = {
	ajax: function(method, path, data) {
		path = '/' + path;

		return $.ajax({
			type: method,
			url: path,
			data: data
		});
	}
};
