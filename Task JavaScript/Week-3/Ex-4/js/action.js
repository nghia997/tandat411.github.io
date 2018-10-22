$(document).ready(function () {
	var view = $('#js-view');
	var cloud = (function () {
		var items = $('.js-item');
		// Position of mouse
		var position = 0;
		var distance = 0.7;
		// Limit distance to move left and right
		var limit	 = 100;

		/* Function get position of mouse when user mouse move on the view.
			- Input: event.
			- Output: get position of mouse and set CSS for all cloud to move left or right.
		*/
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
