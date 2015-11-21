$(function() {
	//  Add a JS support hook in the CSS so we can
	//  have appropriate fallbacks in place.
	$('html').removeClass('no-js').addClass('js');

	//  Make inputs a little easier to understand
	//  by providing bits of data we already know
	//  but leaving them unselectable or editable.
	$('.hint').each(function() {
		var $me = $(this);

		if($me.prev().is('input')) {
			var $prev = $me.prev();
			$prev.css('padding-left', $me.width() + parseInt($prev.css('padding-left')) + 2);
		}
	});

	//  Auto-slug any element by adding a data-slugify
	//  attribute to an element
	$.dataHook('slugify', function($me, $target) {
		$target.on('keyup', function() {
			$me.text(slugify($target.val()));
		});
	});

	$.dataHook('editable', function($me, $target) {
		$me.on('keyup blur', function() {
			$target.val($me.text());
		});
	});

	$.dataHook('edit', function($me, $target) {		
		var attr = 'contenteditable', originalText = $me.text();

		$me.on('click', function(e) {
			e.preventDefault();

			if($target.attr(attr)) {
				$me.text(originalText);
				$target.removeAttr(attr).off('blur');
			} else {
				$me.text($me.attr('data-onedit'));
				$target.attr(attr, true).select().focus().on('blur', function() {
					$target.text(slugify($target.text()));
				});
			}
		});
	});

	$.dataHook('conditional', function($me, $target) {
		$me.on('change', function() {
			if($me.val() == 'false') {
				$target.addClass('hidden');
			} else {
				$target.removeClass('hidden');
			}
		}).trigger('change');
	});

	$.dataHook('infinite', function($me, $target) {
		$me.addClass('ghost').on('click', function() {
			$me.toggleClass('ghost');
			
			if($target.prop('disabled')) {
				$target.val(1).prop({ disabled: false, placeholder: '' });
			} else {
				$target.val('').prop({ disabled: true, placeholder: 'Unlimited' });
			}
		}).trigger('click');
	});

	$('.image-uploader').each(function() {
		var $me = $(this);

		$me.dropzone({
			url: $me.parents('form').attr('action'),
			addRemoveLinks: true,
			clickable: true,
			autoProcessQueue: false,
			paramName: $me.attr('name'),
			maxFiles: 1,
			acceptedFiles: 'image/*',
			thumbnailWidth: $me.width(),
			thumbnailHeight: $me.height()
		});
	});

	//  Replace all selects with a more friendly
	//  faux-select, since we don't have that many
	//  options available.
	$('select:not(.no-faux)').each(function() {
		var $me = $(this),
			$faux = $('<span class="faux-select" />');

		$me.children('option').each(function() {
			var $option = $(this),
				$item = $('<span class="option" />'),
				val = $option.val();

			$item.attr('value', val).text($option.text()).on('click', function() {
				$me.val(val).trigger('change');
				$item.addClass('selected').siblings().removeClass('selected');
			});

			if($option.is(':selected')) {
				$item.addClass('selected');
			}

			$faux.append($item);
		});

		$me.after($faux);
	});

	//  Auto-listen for any required elements to be filled in
	//  before the form's allowed to be submitted.
	//  Lazy but effective.
	var input = $('input'),
		submit = $('button');

	input.keyup(function() {
		var $me = $(this);

		if($me.val() === '') {
			$me.addClass('empty');
		} else {
			$me.removeClass('empty');
		}

		if(input.filter('[required]').filter(function() { return this.value == "" }).length) {
			submit.attr('disabled', 'disabled');
		} else {
			submit.removeAttr('disabled');
		}
	}).trigger('keyup');

	//  Add a Twitter-style counter to elements with maxlength on
	//  so the user knows how long they've got to write.
	input.filter('[maxlength]').add('textarea[maxlength]').on('keyup', function() {
		var $me = $(this);

		if($me.next().is('.help')) {
			$me.after('<span class="counter" />');
		}

		$me.next().text($me.attr('maxlength') - $me.val().length + ' characters left');
	}).trigger('keyup');
});

$.dataHook = function(hook, callback) {
	var $hook = $('[data-' + hook + ']'), $target = $($hook.attr('data-' + hook));
	return $.isFunction(callback) && callback($hook, $target);
}

function slugify(e) {
	return e.toLowerCase().replace(/\s+/g,"-").replace(/[^\w\-]+/g,"").replace(/\-\-+/g,"-").replace(/^-+/,"").replace(/-+$/,"");
}