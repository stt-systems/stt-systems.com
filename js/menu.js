$(document).ready(function () {
	var bMobile; // true if in mobile mode

	// Initiate e handlers
	function init() {
		bMobile = $('.navbar-toggle').is(':visible'); // .navbar-toggle is only visible in mobile mode

		var nTimer,
			oMenus = $('#stt-navbar-collapse .dropdown'),
			oMenusA = $('#stt-navbar-collapse .dropdown > a'),
			oSubMenusA = $('#stt-navbar-collapse .dropdown-submenu > a');

		oMenus.off();
		oMenusA.off();
		oSubMenusA.off();

		if (bMobile) {
			oMenus.on({
				'click touchstart': function(e) {
					e.stopPropagation();
				}
			});
			oMenusA.on({
				'click touchstart': function(e) {
					oMenusA.parent().removeClass('open');
					$(this).parent().addClass('open');
				}
			});
			oSubMenusA.on({
				'click touchstart': function(e) {
					oSubMenusA.parent().removeClass('open');
					$(this).parent().addClass('open');
				}
			});
		} else {
			oMenus.on({
				'mouseenter': function(e) {
					e.preventDefault();
					clearTimeout(nTimer);
					oMenus.removeClass('open');
					$(this).addClass('open').slideDown();
				},
				'mouseleave': function() {
					nTimer = setTimeout(function () {
						oMenus.removeClass('open');
					}, 500);
				}
			});
		}
	}
	$(document).ready(function() {
		init();
	});
	$(window).resize(function() {
		init();
	});
});
