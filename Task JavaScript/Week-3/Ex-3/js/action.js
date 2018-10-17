$(document).ready(function () {
	var calendar = $('#js-calendar');
	var iconCalendar = $('#js-icon-calendar');

	// Event change CSS show or hide of calendar when user click on icon calendar
	iconCalendar.click(function () {
		if (calendar.css('display') == 'none') calendar.css('display', 'block');
		else calendar.css('display', 'none');
	});


});