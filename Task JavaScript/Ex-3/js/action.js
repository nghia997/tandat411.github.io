$(document).ready(function () {
	var btnPrev   = $('#btn-prev');
	var btnNext   = $('#btn-next');
	var listItems = $('#js-list-item');
	var listThumbs= $('#js-list-thumb');
	var maxLength = listItems.children().length;
	var count     = 0;

	listThumbs.children('li:first').css('opacity', '0.5');

	function setOpacity(position) {
		listThumbs.children().css('opacity', '1');
		listThumbs.children().eq(position).css('opacity', '0.5');
	}

	btnPrev.click(function () {
		count -= 1;
		if(count < 0) {count = maxLength - 1;}
		listItems.children().hide();
		listItems.children().eq(count).show();
		setOpacity(count);
	});

	btnNext.click(function () {
		count += 1;
		if(count > 4) {count = 0;}
		listItems.children().hide();
		listItems.children().eq(count).show();
		setOpacity(count);
	});

	$(document).on('click', '#js-list-thumb li', function () {
		var pos = $(this).index();
		setOpacity(pos);
		listItems.children().hide();
		listItems.children().eq(pos).show();
	});
});