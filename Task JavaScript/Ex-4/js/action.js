$(document).ready(function () {
	var menu = $('.js-list-menu');
	var listMenu = menu.children();

	setPointerEvents(menu, listMenu);
	listMenu.hide();
	listMenu.eq(0).show();

	menu.click(function () {
		listMenu.show();
		setPointerEvents(listMenu, menu);
	});

	listMenu.click(function (event) {
		var position = $(this).index();
		listMenu.hide();
		$(this).show();
		setPointerEvents(menu, listMenu);
		event.stopPropagation();
	});

	function setPointerEvents(element1, element2) {
		element1.css('pointer-events', 'auto');
		element2.css('pointer-events', 'none');
	}
})