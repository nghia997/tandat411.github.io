$(document).ready(function () {
	var str      = $('#js-txt-name');
	var btnAdd   = $('#js-btn-add');
	var list  	 = $('#list');
	var maxLength= 30;

	str.focus();

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

		for (var i = 0; i < list.children().length; i++) {
			var posLi = list.children()[i].innerText;
			var sub = posLi.substr(0, posLi.length - 1);
			
			if (name.toUpperCase() == sub.toUpperCase()) {
				alert('This name was already exist!');
				return false;
			}
		}
		
		list.append('<li class="item">' + name + '<button id="js-btn-remove"> X</button></li>');
		str.val('');
		str.focus();
	});

	$(document).on('click', '#js-btn-remove', function () {
		$(this).parent().remove();
	});
});
