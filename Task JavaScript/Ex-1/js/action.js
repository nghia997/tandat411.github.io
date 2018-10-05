$(document).ready(function () {
	var str      = $('#txt-name-js');
	var btnAdd   = $('#btn-add');
	var list  	 = $('#list');

	btnAdd.click(function () {
		var name = str.val().trim();
		if (name === '') {
			alert('Bạn chưa nhập tên sản phẩm.');
			return false;
		}

		list.append('<li class="item"><span>' + ' </span>' + name + '<button id="btn-remove"> X</button></li>');
		str.val('');
	});


	$(document).on('click', '#btn-remove', function () {
		$(this).parent().remove();
	})
})