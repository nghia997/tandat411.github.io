$(document).ready(function () {
	var message = $('#js-message');
	var history = $('#js-history');
	var btnSend = $('#js-btn-send');
	var roomId = $('#js-room').val();
	var itemId = $('#js-item').val();
	var clientId = $('#js-client').val();
	var messageFrom = $('#js-from').val();
	var url = window.location.href;
	var pathName = url.substr(0, url.indexOf('Chat-Online') + 11);

	// Send message when user click on button 'Send'
	btnSend.click(function () {
		msg = message.val();
		message.val('');
		$.ajax({
			url: pathName + '/ajax-send',
			type: 'post',
			data: {'message': msg, 'itemId': itemId, 'roomId': roomId, 'clientId': clientId, 'messageFrom': messageFrom},
			success: function (data) {
				history.html(data);
			}
		});
	});

	// Auto update message in 1s
	setInterval(function () {
		$.ajax({
			url: pathName + '/ajax-load',
			type: 'post',
			data: {'itemId': itemId, 'roomId': roomId},
			success: function (data) {
				history.html(data);
			}
		});
	}, 1000);
});
