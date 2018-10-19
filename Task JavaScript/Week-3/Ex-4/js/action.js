$(document).ready(function () {
	var view = $('#js-view');
	var cloud = (function () {
		var items = $('.js-item');
		var position = 0;
		var distance = 0.7;
		var limit	 = 100;

		function startMove(event) {
			if (event.pageX > position && parseInt(items.css('left')) < limit) {
				items.css({left: '+=' + distance});
			} else if (parseInt(items.css('right')) < limit) {
				items.css({left: '-=' + distance});
			}
			position = event.pageX;
		};

		return {
			move: function (event) {
				startMove(event);
			}
		}
	}) ();

	view.mousemove(function (event) {
		cloud.move(event);
	})
});
