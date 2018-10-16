$(document).ready(function () {
	var columnChart  = (function () {
		var canvas   = $('#js-canvas').get(0);
		var context  = canvas.getContext('2d');
		var x        = canvas.width; // get width of canvas
		var y        = canvas.height; // get height of canvas

		/* Draw column chart*/
		function run() 
		{
			if (item.length > 5) {
				alert('Sum value of columns must be less than 5');
				return false;
			}

			drawText(text.fontTitle, text.title, x / 4, 100, color.black);
			drawText(text.font, text.nameProject, x - (x * 0.6), y - (y * 0.2), color.gray);
			drawTextRight();
			drawTextLeft(text.font, x / 7, y - (y * 0.3), -Math.PI / 2, color.gray, text.note);
			drawChart();
		}

		/*
			- Input: font for text, value of the text, position(x, y) of the text, color of the text
			- Output: draw a text.
		*/
		function drawText(font, text, positionX, positionY, color) 
		{
			context.beginPath();
			context.font = font;
			context.fillStyle = color;
			context.fillText(text, positionX, positionY);
			context.fill();
		}

		/*
			- Input: font for text, position(x, y) to move the text, degree to rotate the text,
					 color of the text, value of the text.
			- Output: draw a text on the left.
		*/
		function drawTextLeft(font, translateX, translateY, degree, color, text) 
		{
			context.save();
			context.beginPath();
			context.translate(translateX, translateY);
			context.rotate(degree);
			context.font = font;
			context.fillStyle = color;
			context.fillText(text, 0, 0);
			context.fill();
			context.restore();
		}

		/*
			- Input: none.
			- Output: draw a text on the right and a blue rectangle on the top of the text.
		*/
		function drawTextRight() 
		{
			// Draw a rectangle with width: 60px, height: 30px
			drawRectangle(x - (x * 0.1) - 20, (y - 10) - (y * 0.7), 60, 30);

			// Split the text to array and draw all single text in array with gray color, font: 20px Arial
			var arr = text.note.split(' ');
			for (var i = 0; i < arr.length; i++) {drawText(text.font, arr[i], x - (x * 0.1) - 20, (y / 3) + ((i+1) * 30), color.black);}
		}

		/*
			- Input: position(x, y) of the rectangle, width, height.
			- Output: draw a blue rectangle.
		*/
		function drawRectangle(pointX, pointY, width, height) 
		{
			context.save();
			context.beginPath();
			context.fillStyle = color.blue;
			context.fillRect(pointX, pointY, width, height);
			context.fill();
			context.restore();
		}
		
		/*
			- Input: none.
			- Output: draw a with 5 columns and 4 levels.
		*/
		function drawChart() 
		{
			// Width of rectangle
			var width  = 60;
			// Height of Rectangle
			var height = 60;
			// Start position(x, y)
			var startX = x / 5 + 30;
			var startY = (y - 10) - (y * 0.3);
			// End position(x, y)
			var endX   = (x / 5 + 30) + (width * 2 * item.length);
			var endY   = (y - 10) - (y * 0.3);
			// Position(x, y) of levels
			var levelX = x / 5;
			var levelY = y - (y * 0.3);

			// Draw line for all levels
			for (var i = 0; i < level.length; i++) {
				// In first line the color is black and the other line is gray
				if (i == 0) {drawLine(startX, startY - (i * height), endX, endY - (i * height), color.black);}
				else {drawLine(startX, startY - (i * height), endX, endY - (i * height), color.gray);}
			}

			for (var i = 0; i < item.length; i++) {
				// Draw level
				drawText(text.font, level[i], levelX, levelY - (i * height), color.gray);
				// Draw name of item
				drawText(text.font, item[i].name, startX + 20 + (i * width * 2), startY + 30, color.gray);
				// Draw value of item
				drawRectangle(startX + (i * width * 2), startY - (item[i].value * height), width, height * item[i].value);
			}
		}

		/*
			- Input: Start position(x, y) and End position(x, y) of the line, color.
			- Output: draw a line.
		*/
		function drawLine(startX, startY, endX, endY, color) 
		{
			context.beginPath();
			context.moveTo(startX, startY);
			context.lineTo(endX, endY);
			context.strokeStyle = color;
			context.stroke();
		}

		return {
			drawColumnChar : run
		}
	}) ();

	columnChart.drawColumnChar();
});
