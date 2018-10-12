$(document).ready(function () {
	var menu      = $('.js-list-menu'); // Get tag <ul> list menu
	var listMenu  = menu.children();	// Get all tag <li> in tag <ul> list menu
	var btnPre    = $('#js-btn-previous');
	var btnNext   = $('#js-btn-next');
	var listItem  = $('.js-list-item'); // Get tag <ul> list item
	var view      = $('#js-view__show');  // Get the view show up list image 
	var imageWidth = parseInt(listItem.children().css('width')); // Get width of the single image in list item
	var maxLength = listMenu.length;	// Get length of list menu
	var position  = 0;	// Get position of tag <li>
	var autoPlay  = autoSlide(); // Start auto slide image

	/* Set pointer-events auto for tag <ul> list menu and none for list tag <li> in tag <ul> list menu
		- Input: object <ul>, object <li>.
		- Output: CSS pointer-events of tag <ul> was auto and tag <li> was none.''
	*/
	setPointerEvents(menu, listMenu);

	// Show first item in  list item
	showMenu(0);

	// Event swipe to left in mobile phone
	view.on('swipeleft', function () {
		clearInterval(autoPlay); // Stop setInterval()
		autoPlay = autoSlide();  // Start setInterval() again
		slideNext();  // Slide to next image
	});

	// Event swipe to right in mobile phone
	view.on('swiperight', function () {
		clearInterval(autoPlay); // Stop setInterval()
		autoPlay = autoSlide();  // Start setInterval() again
		slidePrevious();  // Slide to previous image
	});

	// Event when user click on tag <ul> list menu
	menu.click(function () {
		listMenu.show(); // List tag <li> in tag <ul> list menu showed

		/* Set pointer-events auto for tag <li> in tag <ul> list menu and auto for list tag <ul> list menu
		- Input: object <li>, object <ul>.
		- Output: CSS pointer-events of tag <li> was auto and tag <ul> was none.''
		*/
		setPointerEvents(listMenu, menu); 
	});

	/* Event when user click on single tag <li> in tag <ul> list menu
	- Input: event.
	- Output: all tag <li> in tag <ul> list menu will hide and this tag <li> will show.
	*/
	listMenu.click(function (event) {
		position = $(this).index(); //Get this position of tag <li>
		var distance = position * imageWidth; // Get distance from first tag <li> to this tag <li>

		// Set CSS for this tag <li> with left = -distance
		listItem.animate({left: '-' + distance + 'px'});
		showMenu(position);  // Show this item in list item
		setPointerEvents(menu, listMenu);
		clearInterval(autoPlay);
		autoPlay = autoSlide();
		event.stopPropagation(); // Stop all event in class parent of this tag <li>
	});

	/* Event when user click on button next (arrow right)
	- Input: none.
	- Output: slide to next image.
	*/
	btnNext.click(function () {
		multiClick(); // Make user can't click many on button next
		slideNext(); // Slide to next image

		// Reset setInterval()
		clearInterval(autoPlay);
		autoPlay = autoSlide();
	});

	/* Event when user click on button previous (arrow left)
	- Input: none.
	- Output: slide to previous image.
	*/
	btnPre.click(function () {
		multiClick();
		slidePrevious(); // Slide to previous image
		clearInterval(autoPlay);
		autoPlay = autoSlide();
	});

	/*

	*/
	function setPointerEvents(element1, element2) {
		element1.css('pointer-events', 'auto');
		element2.css('pointer-events', 'none');
	}

	/* Set timeout when user click many time with CSS pointer-events
		Input: none,
		Output: User can't click on button next and previous.
	*/
	function multiClick() {
		btnPre.css('pointer-events', 'none');
		btnNext.css('pointer-events', 'none');
		setTimeout(function () {
			btnPre.css('pointer-events', 'auto');
			btnNext.css('pointer-events', 'auto');
		}, 1000);
	}

	/* Function show tag <li> in tag <ul> list menu with position
		Input: position of object you want to show,
		Output: this tag <li> will show.
	*/
	function showMenu(position) {
		listMenu.hide(); // Hide all tag <li>
		listMenu.eq(position).show(); // Show this tag <li>
	}

	// Auto slide to next image in 3s
	function autoSlide() {
		var start = setInterval(function () {slideNext();}, 3000); // set interval in 3s
		return start; // return this setInterval()
	}

	// Funtion slide to next image
	function slideNext() {
		position += 1;
		// If position > (length of all tag <li>) - 1 --> position = 0
		if (position > maxLength - 1) {
			position = 0;
			// Set left of CSS to the first image
			listItem.animate({left: '0'}); 
			showMenu(position); // Show the menu with this position in list menu
			return false;
		}

		// Else set left of CSS with value is subtract the width of image
		listItem.animate({left: '-=' + imageWidth + 'px'});
		showMenu(position);
	}

	// Funtion slide to previous image
	function slidePrevious() {
		position -= 1;
		// If position < 0 --> position = (length of all tag <li>) - 1
		if (position < 0) {
			position = maxLength - 1;
			// Set left of CSS to the last image
			listItem.animate({left: '-' + (position * imageWidth) + 'px'});
			showMenu(position); // Show the menu with this position in list menu
			return true;
		}
		// Else set left of CSS with value is sum the width of image
		listItem.animate({left: '+=' + imageWidth + 'px'});
		showMenu(position);
	}
})