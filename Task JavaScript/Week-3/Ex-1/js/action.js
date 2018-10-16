$(document).ready(function () {
	var canvas   = $('#js-canvas').get(0);
	var context  = canvas.getContext('2d');
	var pi       = Math.PI;
	var x        = canvas.width / 2; // Center X of circle
	var y        = canvas.height / 2; // Center Y of circle
	var scaleX   = 1;
	var scaleY   = 0.4; // scale with point Y to make circle become eclipe
	var radius   = 200; // Radius of circle
	var distance = 10; // distance between fail and success

	// Start draw 3D Pie chart
	draw();

	// Function draw 3D Pie chart
	function draw()
	{
		// Validate the value success and value fail
		if (((data.success + data.fail) < 1) || ((data.success + data.fail) > 1)) {
			alert('Wrong value success or value fail');
			return false;
		}

		/*	if value success > fail: draw Fail below Success with distance
			else value success >= fail: draw Success below Fail with distance
		*/
		if (data.success > data.fail) {
			for(var i = 100; i > 0; i--) {
					drawSuccess(i, 0);
					drawFail(i, distance);
				}
		} else {
			for(var i = 100; i > 0; i--) {
					drawSuccess(i, distance);
					drawFail(i, 0);
			}
		}

		/*	if value success = 1: draw line and text of Success
			if value fail = 1: draw line and text of Fail
			else: draw line and text both of them
		*/
		if (data.success == 1) {drawLineSuccess();}
		else if (data.fail == 1) {drawLineFail();}
		else {
			drawLineSuccess();
			drawLineFail();
		}

		drawTitle(); // draw the title for this Pie chart
	}

	/*
		- Input: a value to set position for overload Success cicle,
				distance to set height distance with Fail circle.
		- Output: draw 3D Success circle distance with Fail circle,
				color is dark blue on top and blue below.
	*/
	function drawSuccess(value, distance) 
	{
		var startAngle = (data.success == 0.5) ? x : x + distance;
		var endAngle   = (distance > 0) ? (data.success <= 0.05) ? y + value : y + distance + value : y - distance + value;
		
		// Draw Success circle
		context.save(); // Save this state
		context.scale(scaleX, scaleY);
		context.beginPath();
		context.arc(startAngle, endAngle, radius, 0, 2 * pi * data.success);
		context.lineTo(startAngle, endAngle);
		context.fillStyle = (value == 1) ? color.darkBlue : color.blue;
		context.fill();
		context.restore(); // Return back to this state
	}

	/*
		- Input: a value to set position for overload Fail cicle,
				distance to set height distance with Success circle.
		- Output: draw 3D Fail circle distance with Success circle,
				color is dark red on top and red below.
	*/
	function drawFail(value, distance) 
	{
		var startAngle = x + distance;
		var endAngle   = (data.fail <= 0.05) ? y + value : y - distance + value;

		// Draw Fail circle
		context.save(); // Save this state
		context.scale(scaleX, scaleY);
		context.beginPath();
		context.arc(startAngle, endAngle, radius, 0, 2 * pi * -(1- data.success), true);
		context.lineTo(startAngle, endAngle);
		context.fillStyle = (value == 1) ? color.darkRed : color.red;
		context.fill();
		context.restore(); // Return back to this state
	}

	/*
		- Input: none.
		- Output: draw a line with color is blue,
				draw a text with data and text: ĐÃ ĐẠT in file "data.js".
	*/
	function drawLineSuccess() 
	{
		var alpha     = pi * data.success;
		var xEnd      = x + (radius * Math.cos(alpha));
		var yEnd      = y + (radius * Math.sin(alpha));
		var positionX = (x + xEnd) / 2;
		var positionY = ((y + yEnd) / 2) * scaleY;

		// Draw line Success
		context.beginPath();
		context.moveTo(x / 5, y / 5);
		context.lineTo(x / 2, y / 5);
		context.lineTo(positionX + 70, positionY);
		context.strokeStyle = color.blue;
		context.lineWidth = 3;
		context.stroke();

		// Draw text Success
		context.beginPath();
		context.font = text.font;
		context.fillStyle = text.color;
		context.fillText((data.success * 100) + "% " + text.success, x / 5, y / 5 - 10);
		context.fill();
	}

	/*
		- Input: none.
		- Output: draw a line with color is red,
				draw a text with data and text: CHƯA ĐẠT in file "data.js".
	*/
	function drawLineFail() 
	{
		var alpha     = 2 * pi - (pi * data.fail);
		var xEnd      = x + (radius * Math.cos(alpha));
		var yEnd      = y + (radius * Math.sin(alpha));
		var positionX = (x + xEnd) / 2;
		var positionY = ((y + yEnd) / 2) * scaleY;

		// Draw line Fail
		context.beginPath();
		context.moveTo(x + (x * 0.7), y / 5);
		context.lineTo(x + (x * 0.4), y / 5);
		context.lineTo(positionX + 50, positionY);
		context.strokeStyle = color.red;
		context.lineWidth   = 3;
		context.stroke();

		// Draw text Fail
		context.beginPath();
		context.font      = text.font;
		context.fillStyle = text.color;
		context.fillText((data.fail * 100) + "% " + text.fail, x + (x * 0.4), y / 5 - 10);
		context.fill();
	}

	/*
		- Input: none.
		- Output: draw a text title at center with data title: BIỂU ĐỒ TỔNG QUÁT KHUNG NĂNG LỰC,
		 font: 20px Arial,
		 color: dark blue in file "data.js".
	*/
	function drawTitle() 
	{
		context.beginPath();
		context.font      = text.font;
		context.fillStyle = color.darkBlue;
		context.textAlign = "center";
		context.fillText(text.title, x, y);
		context.fill();
	}
});
