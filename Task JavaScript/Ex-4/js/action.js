$(document).ready(function () {
	var menu      = $('.js-list-menu');
	var listMenu  = menu.children();
	var btnPre    = $('#js-btn-previous');
	var btnNext   = $('#js-btn-next');
	var listItem  = $('.js-list-item');
	var view      = $('#js-view');
	var viewWidth = parseInt(view.css('width'));
	var maxLength = listMenu.length;
	var position  = 0;
	var autoPlay  = autoSlide();

	setPointerEvents(menu, listMenu);
	showMenu(0);


	view.on('swipeleft', function (event) {
		event.preventDefault();
		clearInterval(autoPlay);
		autoPlay = autoSlide();
		slideNext();
	});

	view.on('swiperight', function (event) {
		event.preventDefault();
		clearInterval(autoPlay);
		autoPlay = autoSlide();
		slidePrevious();
	});

	menu.click(function () {
		listMenu.show();
		setPointerEvents(listMenu, menu);
	});

	listMenu.click(function (event) {
		position = $(this).index();
		var distance = position * viewWidth;

		listItem.animate({left: '-' + distance + 'px'});
		showMenu(position);
		setPointerEvents(menu, listMenu);
		clearInterval(autoPlay);
		autoPlay = autoSlide();
		event.stopPropagation();
	});

	btnNext.click(function () {
		multiClick();
		slideNext();
		clearInterval(autoPlay);
		autoPlay = autoSlide();
	});

	btnPre.click(function () {
		multiClick();
		slidePrevious();
		clearInterval(autoPlay);
		autoPlay = autoSlide();
	});

	function setPointerEvents(element1, element2) {
		element1.css('pointer-events', 'auto');
		element2.css('pointer-events', 'none');
	}

	function multiClick() {
		btnPre.css('pointer-events', 'none');
		btnNext.css('pointer-events', 'none');
		setTimeout(function () {
			btnPre.css('pointer-events', 'auto');
			btnNext.css('pointer-events', 'auto');
		}, 1000);
	}

	function showMenu(position) {
		listMenu.hide();
		listMenu.eq(position).show();
	}

	function autoSlide() {
		var start = setInterval(function () {slideNext();}, 3000);
		return start;
	}

	function slideNext() {
		position += 1;
		if (position > maxLength - 1) {
			position = 0;
			listItem.animate({left: '0'});
			showMenu(position);
			return false;
		}

		listItem.animate({left: '-=' + viewWidth + 'px'});
		showMenu(position);
	}

	function slidePrevious() {
		var listItemWidth = parseInt(listItem.css('width'));
		position -= 1;
		if (position < 0) {
			position = maxLength - 1;
			listItem.animate({left: '-' + (listItemWidth - viewWidth) + 'px'});
			showMenu(position);
			return true;
		}

		listItem.animate({left: '+=' + viewWidth + 'px'});
		showMenu(position);
	}
})