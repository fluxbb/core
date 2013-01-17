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
	});
});
