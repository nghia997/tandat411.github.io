$(document).ready(function () {
	var list = $('#js-list-group');
	var group = $('#js-group');
	var url = window.location.href;
	var pathName = url.substr(0, url.indexOf('Chat-Online') + 11);

	// Show message box when shop click on every group chat
	$(document).on('click', '#js-list-group li', function () {
		var groupId = $(this).children('#js-group-id').val();
		$.ajax({
			method: 'post',
			url: pathName + '/ajax-group',
			data: {'groupId': groupId},
			success: function (data) {
				group.html(data);
			}
		});
	});
});