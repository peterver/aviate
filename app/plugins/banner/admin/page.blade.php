<h1>Manage banners</h1>

{{ Form::open() }}
	@foreach(get_banners() as $id => $banner)
		<p>
			<label for="banner-{{ $id }}">Banner content</label>
			<input name="banner-{{ $id }}" id="banner-{{ $id }}" value="{{ $banner }}">

			<a class="inline-input-link symbol remove" title="Remove banner">&times;</a>
		</p>
	@endforeach

		<p class="new">
			<label>New banner content</label>
			<input>

			<a class="inline-input-link symbol add" title="Remove banner">+</a>
		</p>

	<button type="submit">Save banners</button>
{{ Form::close() }}

@section('scripts')
<script>
	var $clone = $('<p><label>Banner content</label><input /><a class="inline-input-link symbol remove" title="Remove banner">&times;</a></p>');
	var add = function(text) {
		//  Clear the textbox
		this.val('');

		//  Copy a banner item
		var $new = $clone.clone().hide();

		//  Fill in the input
		var id = 'banner-' + ~~(Math.random() * 1e3);
		$new.find('input').val(text).attr({id: id, name: id});
		$new.find('label').attr('for', id);

		//  Slide it in
		$new.insertBefore('.new').slideDown(250);
	};

	var remove = function() {
		this.parents('p').slideUp(250, function() {
			this.remove();
		});
	};

	$('.inline-input-link').on('click', function() {
		var $me = $(this);

		window[$me.attr('class').split(' ')[2]].call($me, $me.siblings('input').val());
	});
</script>
@stop