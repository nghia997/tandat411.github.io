$(document).ready(function () {
	var str      = $('#js-txt-name');
	var btnAdd   = $('#js-btn-add');
	var list  	 = $('#list');
	var maxLength= 30;

	btnAdd.click(function () {
		var name = str.val().trim();

		if (name === '') {
			alert('The name of product must not be empty.');
			str.focus();
			return false;
		}

		if (name.length > maxLength) { 
			alert('The string length must be less than '+ maxLength + '.');
			str.val('');
			str.focus();
            return false;
		}
		
		list.append('<li class="item"><span>' + ' </span>' + name + '<button id="js-btn-remove"> X</button></li>');
		str.val('');
		str.focus();
	});

	$(document).on('click', '#js-btn-remove', function () {
		$(this).parent().remove();
	});
});
