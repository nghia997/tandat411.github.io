$(document).ready(function () {
	var container = $('#js-container');
	fallingDown();
	function fallingDown() {
		setInterval(function () {
			var positionLeaves = Math.floor(Math.random() * 5) + 1;
			var positionFall   = Math.floor(Math.random() * parseInt(container.css('width')));

			TweenMax.fromTo(
				$('#js-leaves' + positionLeaves), // Target
				7, // Time to move
				{	// From position
					x: positionFall,
					y: -100
				}, 
				{
					y: 1000,
					skewX: 1000,
					skewY: 1000
				}
			);
		}, 2000);
	}
});
