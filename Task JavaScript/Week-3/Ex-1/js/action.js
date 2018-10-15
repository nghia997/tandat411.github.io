$(document).ready(function () {
	var canvas = $('#js-canvas').get(0);
	var context = canvas.getContext('2d');
	var pi = Math.PI;
	var x = canvas.width / 2;
	var y = canvas.height / 2;
	var scaleX = 1;
	var scaleY = 0.4;
	var radius = 200;
	var distance = 20;

	draw();

	function draw()
	{
		if (data.success > 1 || data.fail > 1 || (data.success == 1 && data.fail == 1)
			|| (data.success == 1 && data.fail > 0) || (data.fail == 1 && data.success > 0)) {
			alert('Wrong value success or value fail');
			return false;
		}

		if (data.success > data.fail) {
			if (data.success == 1) {
				for(var i = 100; i > 0; i--) {drawSuccess(i, 0);}
				drawLineSuccess();
			} else {
				for(var i = 100; i > 0; i--) {
					drawSuccess(i, 0);
					drawFail(i, distance);
				}
				drawLineSuccess();
				drawLineFail();
			}
		} else {
			if (data.fail == 1) {
				for(var i = 100; i > 0; i--) {drawFail(i, 0);}
				drawLineFail();
			} else {
				for(var i = 100; i > 0; i--) {
					drawSuccess(i, distance);
					drawFail(i, 0);
				}
				drawLineSuccess();
				drawLineFail();
			}
		}
		drawTitle();
	}

	function drawSuccess(value, distance) 
	{
		var startAngle = (data.success == 0.5) ? x : x + distance;
		var endAngle   = (distance > 0) ? y + distance + value : y - distance + value;
		context.save(); // Save this state
		context.scale(scaleX, scaleY);
		context.beginPath();
		context.arc(startAngle, endAngle, radius, 0, 2 * pi * data.success);
		context.lineTo(startAngle, endAngle);
		context.fillStyle = (value == 1) ? color.darkBlue : color.blue;
		context.fill();
		context.restore(); // Return back to this state
	}

	function drawFail(value, distance) 
	{
		startAngle = x + distance;
		endAngle   = y - distance + value;
		context.save(); // Save this state
		context.scale(scaleX, scaleY);
		context.beginPath();
		context.arc(startAngle, endAngle, radius, 0, 2 * pi * -(1- data.success), true);
		context.lineTo(startAngle, endAngle);
		context.fillStyle = (value == 1) ? color.darkRed : color.red;
		context.fill();
		context.restore(); // Return back to this state
	}

	function drawLineSuccess() {
		var alpha = pi * data.success;
		var xEnd = x + (radius * Math.cos(alpha));
		var yEnd = y + (radius * Math.sin(alpha));
		var xPos = (x + xEnd) / 2;
		var yPos = ((y + yEnd) / 2) * scaleY;

		context.beginPath();
		context.moveTo(x / 5, y / 5);
		context.lineTo(x / 2, y / 5);
		context.lineTo(xPos + 70, yPos + 7);
		context.strokeStyle = color.blue;
		context.lineWidth = 3;
		context.stroke();

		context.beginPath();
		context.font = text.font;
		context.fillStyle = text.color;
		context.fillText((data.success * 100) + "% " + text.success, x / 5, y / 5 - 10);
		context.fill();
	}

	function drawLineFail() {
		var alpha = 2 * pi - (pi * data.fail);
		var xEnd = x + (radius * Math.cos(alpha));
		var yEnd = y + (radius * Math.sin(alpha));
		var xPos = (x + xEnd) / 2;
		var yPos = ((y + yEnd) / 2) * scaleY;

		context.beginPath();
		context.moveTo(x + (x*0.7), y / 5);
		context.lineTo(x + (x*0.4), y / 5);
		context.lineTo(xPos + 50, yPos - 5);
		context.strokeStyle = color.red;
		context.lineWidth = 3;
		context.stroke();

		context.beginPath();
		context.font = text.font;
		context.fillStyle = text.color;
		context.fillText((data.fail * 100) + "% " + text.fail, x + (x*0.4), y / 5 - 10);
		context.fill();
	}

	function drawTitle() {
		context.beginPath();
		context.font = text.font;
		context.fillStyle = color.darkBlue;
		context.textAlign = "center";
		context.fillText(text.title, x, y);
		context.fill();
	}
});
