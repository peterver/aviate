//  Admin stuff
//  Woo!
(function($) {
	var Admin = {
		init: function() {
			//  Set some defaults
			this.body = $('body');
			
			this.thumbnail();
			this.updateSlug();
			
			//  Fix the sidebar because CSS sucks
			this.fixSidebarHeight();
		},
		
		thumbnail: function() {
			var input = $('input[type=file]');
			var target = input.parent();
			
			var handle = function() {
				var val = input.val();
				if(val && val !== '') {
					target.addClass('added');
					
					var split = val.split('\\');
						split = split[split.length - 1];
					
					input.prev().html(split + ' added!');
				} else {
					target.removeClass('added');
				}
			};
			
			handle();
			input.change(handle);
		},
		
		updateSlug: function() {
			var title = $('#name');
			var overridden = false;
			var slug = $('#slug').keyup(function() {
				overridden = true;
			});
			
			title.keyup(function() {
				if(overridden == false) {
					slug.val(Admin.slugify(title.val()));
				}
			});
		},
		
		//  If you don't know what this function does,
		//  you're probably still living in that cave.
		//  And who can blame you? It looks nice.
		//  Not a fan of caves, though. Too many bats.
		//  All that said, I like Batman.
		//  Probably because he's not an actual bat.
		fixSidebarHeight: function() {
			$('.sidebar').height(Math.max(this.body.height(), $(document).height()));
		},
		
		slugify: function(str) {
			//  Make everything lowercase
			return str.toLowerCase()
			
			//  Proper "and"s, because that's annoying
			.replace(/&/g, 'and')
			
			//  Strip spaces
			.replace(/ /g, '-')
			
			//  Strip non-alpha characters
			.replace(/[^a-zA-Z0-9_\-]+/, '-')
			
			//  And remove multiple dashes
			.replace(/(\-)+/g, '-');
		}
	};
	
	Admin.init();
})(jQuery);