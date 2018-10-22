$(document).ready(function () {
	var view = $('#js-view');
	var cloud = (function () {
		var item1 = $('.js-item1');
		var item2 = $('.js-item2');
		var item3 = $('.js-item3');
		// Position of mouse
		var position = 0;
		// Speeds for 3 layers
		var distance1 = 0.2;
		var distance2 = 0.5;
		var distance3 = 0.8;
		// Limit distance to move left and right
		var limit	 = 100;

		/* Function get position of mouse when user mouse move on the view.
			- Input: event.
			- Output: get position of mouse and set CSS for all cloud to move left or right.
		*/
		function startMove(event) {
			if (event.pageX > position && parseInt(item1.css('left')) < limit) {
				item1.css({left: '+=' + distance1});
			} else if (parseInt(item1.css('left')) > -limit) {
				item1.css({left: '-=' + distance1});
			}

			if (event.pageX > position && parseInt(item2.css('left')) < limit) {
				item2.css({left: '+=' + distance2});
			} else if (parseInt(item2.css('left')) > -limit) {
				item2.css({left: '-=' + distance2});
			}

			if (event.pageX > position && parseInt(item3.css('left')) < 200) {
				item3.css({left: '+=' + distance3});
			} else if (parseInt(item3.css('left')) > -limit) {
				item3.css({left: '-=' + distance3});
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
