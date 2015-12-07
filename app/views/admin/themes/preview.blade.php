@extends('admin/_layout')

@section('content')
<section class="secondary">
	<div class="filter">
		<input type="search" data-search=".list li" placeholder="Search themes…">
	</div>

	<ul class="theme-list">
		@foreach($themes as $theme)
		<li data-attrs='{{ json_encode($theme) }}'>
			<a href="{{ admin_url('themes/view/' . $theme->slug) }}">
				<img class="screenshot" src="{{ get_theme_url(fallback($theme->screenshot, 'screenshot.png')) }}">
				
				<b>{{ $theme->name }} <em>by {{ $theme->author->name }}</em></b>
			</a>
		</li>
		@endforeach
	</ul>
</section>

<section class="tertiary">
	<iframe src="{{ admin_url('themes/preview/' . $theme->slug) }}"></iframe>
</section>
@stop