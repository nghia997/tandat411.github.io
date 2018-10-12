$(document).ready(function () {
	var imgOff  = $('.js-img-off');
	var imgOn   = $('.js-img-on');
	var content = $('.js-content');
	var imgAbout= $('.js-img-about');
	var popup   = $('.js-popup');
	var imgClose= $('.js-img-close');

	// setTimeout when user click many time
	function multiClick(element) {
		imgOff.css('pointer-events', 'none');
		element.css('pointer-events', 'none');
		setTimeout(function () {
			imgOff.css('pointer-events', 'auto');
			element.css('pointer-events', 'auto');
		}, 1000);
	}

	// Set animate the popup when user click on image off
	imgOff.click(function () {
		var parent = $(this).parent();
		multiClick(imgOn);
		content.animate({height: '0px'}, "fast").hide("fast");
		imgOff.show();
		imgOn.hide();
		
		$(this).hide();
		parent.find(imgOn).show();
		parent.find(content).show(1);
		parent.find(content).animate({height: '200px'});
	});

	// Set animate the popup when user click on image on
	imgOn.click(function () {
		var parent = $(this).parent();
		multiClick(imgOff);
		parent.find(imgOff).show();
		$(this).hide();
		parent.find(content).animate({height: '0px'}).hide("fast");
	});

	// Set CSS and Animate the popup when user click on image About
	imgAbout.click(function () {
		var parent = $(this).parent().parent();
		imgOn.css('pointer-events', 'none');
		imgOff.css('pointer-events', 'none');
		parent.find(popup).animate({top: '100px'}, 1000).show();
	});

	// Set CSS the popup when user click on image Close
	imgClose.click(function () {
		imgOn.css('pointer-events', 'auto');
		imgOff.css('pointer-events', 'auto');
		popup.css('top', '-400px').hide();
	});
});
