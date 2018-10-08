$(document).ready(function () {
	var imgOff = $('.js-img-off');
	var imgOn  = $('.js-img-on');
	var content = $('.js-content');
	
	imgOff.click(function () {
		content.animate({height: '0px'}, "fast").hide("fast");
		imgOff.show();
		imgOn.hide();

		$(this).parent().find(imgOff).hide();
		$(this).parent().find(imgOn).show();
		$(this).parent().find(content).show(1);
		$(this).parent().find(content).animate({height: '180px'});
	});

	imgOn.click(function () {
		$(this).parent().find(imgOff).show();
		$(this).parent().find(imgOn).hide();
		$(this).parent().find(content).animate({height: '0px'}).hide("fast");
	});
})