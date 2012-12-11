//  Dime.js
//  for the default storefront
//  I'll try to comment it, honest.
(function($) {
	//  Set up our Dime object
	var Dime = {
		//  This is where everything gets put together.
		init: function() {
			//  Set some elements we'll use in future
			this.body = $('body').addClass('js-enabled');
			this.search = $('#search');
			
			//  Set our base Masonry object
			this.blocks = $('.products').masonry();
			this.blockHover();
			
			//  Handle the search filtering
			this.handleSearch();
			
			//  Speed dem animations up
			$.fx.speeds._default = 250;
			
			//  And infinite scroll
			this.infiniteScroll();
		},
		
		//  We need to do some handling of the blocks
		//  Because we can't do it reliably in CSS
		blockHover: function() {
			this.blocks.find('li > a').each(function() {
				var me = $(this),
					caption = me.children('.caption');
					
				caption.attr('data-height', caption.height() + 27).addClass('hidden');
				
				//  Toggle visibiliy
				me.bind('mouseover mouseout', function(e) {
					caption.toggleClass('hidden').css('height', e.type == 'mouseover' ? caption.attr('data-height') : 0);
				});
			});
		},
		
		handleSearch: function() {
			var blocks = this.blocks;
			var search = this.search;
			var header = $('h1');
			
			this.search.submit(function() {
				var val = search.find('input').val();
				
				//  Hide all the other blocks
				blocks.animate({opacity: .3});
				
				//  Change the header
				header.animate({width: 0}, function() {
					header.text('Showing all results for “' + val + '”').animate({width: '100%'}, 150);
				});
				
				return false;
			});
		},
		
		infiniteScroll: function() {
			var win = $(window);
			var goodToGo = true;
			var blocks = this.blocks;
			var currentPage = (function() {
				var url = window.location.toString().split('/');
				return url[url.length - 1];
			})() || 1;
			
			if(blocks) {
				var loadMore = function() {
					$.get('/page/' + ++currentPage + '/', function(data) {
						var products = $(data).find('.products li').appendTo(blocks);
						goodToGo = true;
					});
				};
				
				win.scroll(function() {
					var offset = win.scrollTop();
					
					if(goodToGo && offset >= $(document).height()- win.height()) {
						goodToGo = false;
						loadMore();
					}
				});
			}
		}
	};
	
	Dime.init();
})(jQuery);