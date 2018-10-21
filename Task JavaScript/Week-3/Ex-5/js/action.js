$(document).ready(function () {
	var container = $('#js-container');
	var leaves = $('.js-leaves');
	var listLeaves = [];
	// Save all element to list leaves
	for (var i = 0; i < leaves.length; i++) {listLeaves[i] = leaves.eq(i);}
	
	// Start falling leaves
	fallingDown();

	/*
		- Input: none.
		- Output: make all leaves falling down with different position, time and rotation
	*/
	function fallingDown() 
	{
		for (var i = 0; i < listLeaves.length; i++) {
			var value = randomValue();
			
			listLeaves[i].css({left:value.positionStartFall});

			TweenMax.staggerTo(
				listLeaves[i], // Target
				value.time, // Time to move
				{
					rotation: value.rotation,
					delay: value.delay,
					x: value.positionEndFall,
					y: 1000,
					transformOrigin: "left top",
					rotationX: value.rotationX,
					rotationY: value.rotationY,
					onComplete: nextTurn,
					onCompleteParams: [listLeaves[i]]
				}, 
				0.5 // Number of stagger
			);
		}
	}

	/*
		- Input: element.
		- Output: make this element return to start point and set new position, time, rotation to fall.
	*/
	function nextTurn(element) {
		var value = randomValue();

		TweenMax.set(element, {y: -100});
		
		TweenMax.staggerTo(
				element, // Target
				value.time, // Time to move
				{
					rotation: value.rotation,
					x: value.positionEndFall,
					y: 1000,
					transformOrigin: "left top",
					rotationX: value.rotationX,
					rotationY: value.rotationY,
					onComplete: nextTurn,
					onCompleteParams: [element]
				},
			);
	}

	/*
		- Input: none.
		- Output: return a object value with random value of all keys.
	*/
	function randomValue() {
		var value = {
			time: Math.floor(Math.random() * 2) + 5,
			delay: Math.floor(Math.random() * 7),
			rotation: Math.floor(Math.random() * 360),
			rotationX: Math.floor(Math.random() * 360),
			rotationY: Math.floor(Math.random() * 360),
			positionStartFall: Math.floor(Math.random() * container.width()),
			positionEndFall: Math.floor(Math.random() * 300)
		};
		return value;
	}
});
