$(function() {
	//  Restyle the CSS since we have JS support
	$('html').addClass('has-js');

	//  Make the banner fade
	$('.carousel').unfader();
});


/**
 *  github.com/idiot/unfader
 */
(function($) {
	//  No jQuery? No dice.
	if(!$) return false;

	$.fn.unfader = function(opts) {
		var opts = $.extend({
			speed: 800,
			delay: 5000
		}, opts);
		
		var items = this.find('li');
		var total = items.length;
		var current = 0;

		items.each(function() {
			//  Set up the slides
			var me = $(this);

			if(me.index() !== current) {
				me.hide();
			}
		});

		setInterval(function() {
			current++;
			if(current >= total) {
				current = 0;
			}

			items.filter(':visible').fadeOut(opts.speed);
			items.eq(current).fadeIn(opts.speed);
		}, opts.delay);

		return this;
	};
})(window.jQuery);