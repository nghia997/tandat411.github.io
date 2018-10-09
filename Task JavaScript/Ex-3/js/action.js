$(document).ready(function () {
	var btnPrev   = $('#btn-prev');
	var btnNext   = $('#btn-next');
	var listItems = $('.js-list-item');
	var listThumbs= $('.js-list-thumb');

	btnPrev.click(function () {
		listItems.children('li:last').animate({width : '650px'}).prependTo(listItems);
	});

	btnNext.click(function () {
		listItems.children('li:first').animate({width : '0px'}).appendTo(listItems);
	});

	$(document).on('click', '.js-list-thumb li', function () {
		var pos = $(this).index();
		listItems.children().hide();
		//listItems.children()[pos].show();
		listThumbs.children()[pos].css('opacity', '0.5');
	});
});