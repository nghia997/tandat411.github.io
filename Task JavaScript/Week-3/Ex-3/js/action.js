$(document).ready(function () {
	var formInput    = $('#js-form');
	var calendar     = $('#js-calendar');
	var iconCalendar = $('#js-icon-calendar');
	var txtName      = $('#js-name');
	var txtPass      = $('#js-password');
	var txtEmail     = $('#js-email');
	var txtBirthDay  = $('#js-birthday');
	var btnSubmit    = $('#js-btn-submit');
	var btnRefresh   = $('#js-btn-refresh');

	// Event change CSS show or hide of calendar when user click on icon calendar
	iconCalendar.click(function () 
	{
		if (calendar.css('display') == 'none') calendar.css('display', 'block');
		else calendar.css('display', 'none');
	});

	// Event make value of all input to empty when user click on button Refresh.
	btnRefresh.click(function () 
	{
		txtName.val('');
		txtPass.val('');
		txtEmail.val('');
		txtBirthDay.val('');
	});

	// Event check validate input username when user click on other place outside input username
	txtName.blur(function () 
	{
		var name = txtName.val().trim();
		validate($(this), name);
	});

	// Event check validate input password when user click on other place outside input password
	txtPass.blur(function () 
	{
		var password = txtPass.val();
		validate($(this), password);
	});

	// Event check validate input email when user click on other place outside input email
	txtEmail.blur(function () {
		var email = txtEmail.val().trim();
		validate($(this), email);
		checkEmail(txtEmail);
	});

	// Event check validate again for all input user click on button Submit
	btnSubmit.click(function () 
	{
		var name     = txtName.val().trim();
		var password = txtPass.val();
		var email    = txtEmail.val().trim();
		var dob      = txtBirthDay.val();

		validate(txtName, name);
		validate(txtPass, password);
		validate(txtEmail, email);
		validate(txtBirthDay, dob);

		if (!checkBirthDay(txtBirthDay) || !checkEmail(txtEmail) || 
			formInput.children().children().children('.validate').length != 0 ) {
			alert('Submit fail');
			return false;
		} 
		formInput.submit();
		alert('Submit success');
	});

	/* Function check day of birth:
		- Input: object date.
		- Output: return true or false. If false -> append a text error.
	*/
	function checkBirthDay(element) {
		var dob     = txtBirthDay.val();
		var thisRow = element.parent().parent();
		var title   = thisRow.children().get(0).innerText;
		var toDay   = new Date();
		var thisDay = getFormatDate(dob);

		if (thisDay > toDay) {
			if (thisRow.children().get(2) == undefined) {
				thisRow.append("<td class='validate'>" + title + " can't be greater than the current date.</td>");
			} else {
				thisRow.children().get(2).remove();
				thisRow.append("<td class='validate'>" + title + " can't be greater than the current date.</td>");
			}
			return false;
		}
		return true;
	}

	/* Function get correct format of date:
		- Input: date.
		- Output: return this date after convert to correct format.
	*/
	function getFormatDate(date) {
		var arr = date.split('/');
		return new Date(parseInt(arr[2]), parseInt(arr[1])-1, parseInt(arr[0]));
	}

	/* Function check email:
		- Input: object email.
		- Output: return true or false. If false -> append a text error.
	*/
	function checkEmail(element) {
		var thisRow = element.parent().parent();
		var title   = thisRow.children().get(0).innerText;
		var str = element.val().trim();

		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!regex.test(str)) {
			if (thisRow.children().get(2) == undefined) {
				thisRow.append("<td class='validate'>" + title + " Wrong email format.</td>");
			} else {
				thisRow.children().get(2).remove();
				thisRow.append("<td class='validate'>" + title + " Wrong email format.</td>");
			}
			return false;
		}
		return true;
	}

	/* Function validate case value are empty and less than 8 characters for all input:
		- Input: object, value need to check.
		- Output: append the text error.
	*/
	function validate(element, value) 
	{
		var thisRow = element.parent().parent();
		var title   = thisRow.children().get(0).innerText;

		if (value == '') {
			if (thisRow.children().get(2) == undefined) {
				thisRow.append("<td class='validate'>" + title + " must not be empty.</td>");
			} else {
				thisRow.children().get(2).remove();
				thisRow.append("<td class='validate'>" + title + " must not be empty.</td>");
			}
		} else if (value.length < 8) {
			if (thisRow.children().get(2) == undefined) {
				thisRow.append("<td class='validate'>" + title + " must be more than 8 characters.");
			} else {
				thisRow.children().get(2).remove();
				thisRow.append("<td class='validate'>" + title + " must be more than 8 characters.");
			}

		} else if (value.length >= 8 && thisRow.children().get(2) != undefined) {
			thisRow.children().get(2).remove();
		}
	}

});
