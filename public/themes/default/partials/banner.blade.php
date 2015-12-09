@if(function_exists('banners'))
<div class="banner">
	@foreach(banners() as $slide)
	<div class="slide">
		{{ $slide }}
	</div>
	@endforeach
</div>
@endif