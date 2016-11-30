$(function() {



	//---------- Chrome Smooth Scroll ----------//

	//try {
	//	$.browserSelector();
	//	if ($("html").hasClass("chrome")) {
	//		$.smoothScroll();
	//	}
	//} catch (err) {
    //
	//};
    //
	//$("img, a").on("dragstart", function (event) {
	//	event.preventDefault();
	//});



	//---------- CustomScroll ----------//

	//$(".scroll").mCustomScrollbar({
	//	axis: "y", // vertical and horizontal scrollbar
	//	theme: "my-theme",
	//	setHeight: false
	//});
    //
	//var windowWidth = $(window).width();
    //
	//function detectWindowWidth() {
	//	windowWidth = $(window).width();
	//	$(window).resize(function () {
	//		windowWidth = $(window).width();
	//	});
	//}


	
	//---------- Carousel ----------//

	var owl = $(".carousel-3");
	owl.owlCarousel({
		itemsCustom: [
			[0, 1],
			[480, 1],
			[768, 2],
			[992, 3],
			[1200, 4]
		],
		navigation: false,
		pagination: false
	});
	// Custom Navigation Events
	$(".next").click(function () {
		owl.trigger('owl.next');
	});
	$(".prev").click(function () {
		owl.trigger('owl.prev');
	});
	$(".play").click(function () {
		owl.trigger('owl.play', 1000); //owl.play event accept autoPlay speed as second parameter
	});
	$(".stop").click(function () {
		owl.trigger('owl.stop');
	});



	//---------- Modals ----------//

	$(".open-modal").magnificPopup({
		type: 'inline',
		closeBtnInside: true,
		mainClass: "mfp-move-horizontal",
		removalDelay: 500
	});


	$('.advert-variants').magnificPopup({
		delegate: 'a', // child items selector, by clicking on it popup will open
		type: 'image',
		mainClass: 'mfp-with-zoom', // this class is for CSS animation below
		removalDelay: 500,
		zoom: {
			enabled: true, // By default it's false, so don't forget to enable it

			duration: 300, // duration of the effect, in milliseconds
			easing: 'ease-in-out', // CSS transition easing function

			// The "opener" function should return the element from which popup will be zoomed in
			// and to which popup will be scaled down
			// By defailt it looks for an image tag:
			opener: function(openerElement) {
				// openerElement is the element on which popup was initialized, in this case its <a> tag
				// you don't need to add "opener" option if this code matches your needs, it's defailt one.
				return openerElement.is('img') ? openerElement : openerElement.find('img');
			}
		},

		gallery: {
			enabled: true, // set to true to enable gallery

			preload: [0,2], // read about this option in next Lazy-loading section

			navigateByImgClick: true,

			arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button

			tPrev: 'Previous (Left arrow key)', // title for left button
			tNext: 'Next (Right arrow key)', // title for right button
			tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
		}
	});



	//---------- Tabs ----------//

	$('ul.tabs__caption').on('click', 'li:not(.active)', function () {
		$(this)
			.addClass('active').siblings().removeClass('active')
			.closest('div.tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
	});



	//---------- Dotdotdot ----------//

	$(".dotdotdot").dotdotdot({
		ellipsis	: "...",
		watch		: "window"
	});



	//---------- Blur ----------//

	$( ".search input" ).focusin( function(){
		$("main,footer,header .blocks,.section-filter").addClass( "blured animated" ).css({
			"transform": "scaleX(.97)"
		});

		$(".main-menu").css({
			"border-top":"1px solid rgba(255,0,0,.3)",
			"border-bottom":"1px solid rgba(255,0,0,.3)",
		});
		$(".overlay").fadeIn(300);
		$(".often-searches").fadeIn(300);
	});

	$( ".search input" ).focusout( function(){
		$("main,footer,header .blocks,.section-filter").removeClass( "blured" ).css({
			"transform": "scaleX(1)"
		});

		$(".main-menu").css({
			"border-top":"1px solid rgba(0,0,0,.1)",
			"border-bottom":"1px solid rgba(0,0,0,.1)",
		});
		$(".often-searches, .overlay").fadeOut(300);
	});



	//---------- Player ----------//

	//var audioPlayer = $("#audio-player")[0];
    //
	//$("button.prev-audio").on("click", function(){
	//	audioPlayer.play();
	//});
    //
    //
	//$("button.play-audio").on("click", function(){
	//	audioPlayer.play();
	//});
    //
	//$("button.pause-audio").on("click", function(){
	//	audioPlayer.pause();
	//});
    //
	//$("button.stop-audio").on("click", function(){
	//	audioPlayer.pause();
	//	audioPlayer.currentTime = 0;
	//});
    //
    //
	//function updateProgress() {
	//	var progress = $(".progress-line");
	//	var currentTime = audioPlayer.currentTime;
	//	var duration = audioPlayer.duration;
	//	if (audioPlayer.currentTime > 0) {
	//		var value = (currentTime)/duration*100
	//	}
	//	progress.css({
	//		"width" : value+"%"
	//	});
	//}

	// audioPlayer.addEventListener("timeupdate", updateProgress, false);




	// Select sources

	$("#modal-select-sources button.select-all").on("click", function(){
		$("#modal-select-sources .tabs__content.active input").prop('checked', true);
		$("#modal-select-sources .tabs__content.active label").addClass("active");
	});

	$("#modal-select-sources button.deselect-all").on("click", function(){
		$("#modal-select-sources .tabs__content.active input").prop("checked", false);
		$("#modal-select-sources .tabs__content.active label").removeClass("active");
	});

});