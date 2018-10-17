$(document).ready(function () {
	// Tag input Birth Day
	var input = $('#js-birthday');
	var calendar = $('#js-calendar');
	var month = $('#js-month');
	var year  = $('#js-year');
	var toDay = new Date();
	var btnPrevYear = $('#js-prev-year');
	var btnNextYear = $('#js-next-year');
	var btnPrevMonth = $('#js-prev-month');
	var btnNextMonth = $('#js-next-month');
	// The limit date to choice
	var fromYear = 1950;

	// Add year from 1950 to this year
	addYear();
	// Add 12 month
	addMonth();
	// Add day of this month
	getDay();

	// Event get days of month when user select other month
	month.change(function () {getDay();});

	// Event get days of year when user select other year
	year.change(function () {getDay();});

	// Even get days of previous year when user click on button previous year
	btnPrevYear.click(function () {
		// If current year > 1950: year decrement to 1, get days of current month and year.
		if (year.val() > fromYear) {
			year.val(year.val() - 1);
			getDay();
		}
	});

	// Even get days of previous month when user click on button previous month
	btnPrevMonth.click(function () {
		/* 
			If current month = 1 and current month > 1950: year decrement to 1, month = 12.
			Else: month decrement to 1.
			get days of this month and year.
		*/
		if (month.val() == 1) {
			if (year.val() > fromYear) {
				year.val(year.val() - 1);
				month.val(12);
				getDay();
			}
		} else {
			month.val(month.val() - 1);
			getDay();
		}
	});

	// Even get days of next month when user click on button next month
	btnNextMonth.click(function () {
		/* 
			If current month = 12 and current year < 2018: 
				- year increment to 1.
				- month = 1.
				- get days of this month and year.
			Else:
				- month increment to 1.
				- get days of this month and year.
		*/
		if (month.val() == 12) {
			if (year.val() < toDay.getFullYear()) {
				year.val(parseInt(year.val()) + 1);
				month.val(1);
				getDay();
			}
		} else {
			month.val(parseInt(month.val()) + 1);
			getDay();
		}
	});

	// Even get days of next year when user click on button next year
	btnNextYear.click(function () {
		/* 
			If current year = 12 and current year < 2018: 
				- year increment to 1.
				- get days of this month and year.
		*/
		if (year.val() < toDay.getFullYear()) {
			year.val(parseInt(year.val()) + 1);
			getDay();
		}
	});

	// Event set the value for input Birth Day when user choice a day in calendar
	$(document).on('click', '#js-calendar tr:gt(1) td', function () {
		var value = this.innerText + '/' + month.val() + '/' + year.val();
		input.val(value);
		calendar.css('display', 'none');
	});
	
	/* Function add <option> to <select> of year:
	   - Input: none.
	   - Output: add all <option> from year 1950 - this year to <select> of year.
	*/
	function addYear() 
	{
		for (var i = fromYear; i <= toDay.getFullYear(); i++) {
			var check = (i == toDay.getFullYear()) ? "selected" : "";
			year.append("<option value='" + i + "'" + check + ">" + i + "</option");
		}
	}

	// Function to show days of month in calendar
	function getDay() {
		var thisMonth = month.val();
		var thisYear  = year.val();

		removeDay();
		addDay(thisMonth, thisYear);
	}

	// Funtion remove all days of calendar
	function removeDay() {
		var rows = $('#js-calendar tr');
		for (var i = 2; i < rows.length; i++) {rows.eq(i).remove();}
	}

	/* Function add days to calendar
		- Input: month, year.
		- Output: show all days of this month and this year.
	*/
	function addDay(thisMonth, thisYear) 
	{
		var thisYear  = year.val();
		var thisMonth = month.val();
		var numOfDay  = (thisMonth == 2) ? 1 : 0;
		// Find day number of month
		if (checkLeapYear(thisYear)) {numOfDay += getDoM(thisMonth);}
		else if (thisMonth == 2) {numOfDay += getDoM(thisMonth)-1;}
		else {numOfDay += getDoM(thisMonth);}

		var week  = 7;
		var count = 1;
		var flag  = 0;
		var date  = new Date(thisYear, thisMonth - 1).getDay();
		var tag   = "";
		// Add 1 row - 7 column to <table> calendar
		while (count <= numOfDay) {
			tag += "<tr>";
			for (var i = 0; i < week; i++) {
				if (flag < date) {
					tag += "<td class='empty-day'></td>";
					flag++;
				} else if (count <= numOfDay) {
					tag += (count == toDay.getDate() && thisMonth == (toDay.getMonth()+1) && thisYear == toDay.getFullYear()) ? "<td class='to-day'>" : "<td>" ;
					tag += count++;
					tag += "</td>";
				} else {tag += "<td class='empty-day'></td>";}
			}
			tag += "</tr>";
			calendar.append(tag);
			tag = "";

		}
	}

	/* Function get day of month
		- Input: month.
		- Output: return num of days in this month.
	*/
	function getDoM(month) {
		if (month != 2 && (month % 2 != 0) && month != 9 && month != 11 || month == 12 || month == 8 || month == 10) return 31;
		else if (month == 2) return 28;
		else return 30;
	}

	/* Function check year are a leap year or not
		- Input: year.
		- Output: True or False.
	*/
	function checkLeapYear(year) 
	{
		var check = (year % 400 == 0 || (year % 4 ==0 && year % 100 != 0)) ? true : false;
		return check;
	}

	/* Function add <option> to <select> of month:
	   - Input: none.
	   - Output: add 12 <option> to <select>.
	*/
	function addMonth() 
	{
		for (var i = 1; i <= 12; i++) {
			var check = (i == toDay.getMonth()+1) ? "selected" : "";
			month.append("<option value='" + i + "'" + check + ">" + findNoM(i) + "</option");
		}
	}

	/* Function find name of month
	   - Input: value of the month.
	   - Output: return name of month.
	*/
	function findNoM(value) 
	{
		switch (value) {
			case 1:
				return "January";
			case 2:
				return "February";
			case 3:
				return "March";
			case 4:
				return "April";
			case 5:
				return "May";
			case 6:
				return "June";
			case 7:
				return "July";
			case 8:
				return "August";
			case 9:
				return "September";
			case 10:
				return "October";
			case 11:
				return "November";
			case 12:
				return "December";
		}
	}
});
