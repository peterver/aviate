//  Admin stuff
//  Woo!
(function($) {
	var Admin = {
		init: function() {
			this.thumbnail();
			this.updateSlug();
		},
		
		thumbnail: function() {
			var input = $('input[type=file]');
			var target = input.parent();
			
			var handle = function() {
				var val = input.val();
				if(val !== '') {
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
			var title = $('#title');
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