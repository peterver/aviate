<div class="banner">
	@foreach(get_banners() as $slide)
	<div class="slide">
		{{ $slide }}
	</div>
	@endforeach
</div>