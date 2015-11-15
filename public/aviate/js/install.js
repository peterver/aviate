$(function() {
	//  Add a JS support hook in the CSS so we can
	//  have appropriate fallbacks in place.
	$('html').removeClass('no-js').addClass('js');

	//  Replace all selects with a more friendly
	//  faux-select, since we don't have that many
	//  options available.
	$('select').each(function() {
		var $me = $(this),
			$faux = $('<span class="faux-select" />');

		$me.children('option').each(function() {
			var $option = $(this),
				$item = $('<span class="option" />'),
				val = $option.val();

			$item.attr('value', val).text($option.text()).on('click', function() {
				$me.val(val);
				$item.addClass('selected').siblings().removeClass('selected');
			});

			if($option.is(':selected')) {
				$item.addClass('selected');
			}

			$faux.append($item);
		});

		$me.after($faux);
	});


	var input = $('input'),
		submit = $('button');

	input.keyup(function() {
		if(input.filter('[required]').filter(function() { return this.value == "" }).length) {
			submit.attr('disabled', 'disabled');
		} else {
			submit.removeAttr('disabled');
		}
	}).trigger('keyup');

	input.filter('[maxlength]').add('textarea[maxlength]').on('keyup', function() {
		var $me = $(this);

		if($me.next().is('.help')) {
			$me.after('<span class="counter" />');
		}

		$me.next().text($me.attr('maxlength') - $me.val().length + ' characters left');
	}).trigger('keyup');
})