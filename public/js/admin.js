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
			url: "http://fluxbb.dev/index.php/admin/ajax/board_config",
			data: {
				board_title: $('#board-info input.title').val(),
				board_description: $('#board-info input.description').val()
			}
		}).done(function(data) {
			alert('saved');
		});
	});
});
