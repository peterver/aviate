@extends('admin/_layout')

@section('content')
	<div class="list secondary">
		@if(Page::all()->count())
		<ul>
			@foreach(Page::all() as $nav)
			<li @if(Request::is(admin_path('pages/edit/' . $nav->id))) class="active" @endif>
				<a href="{{ admin_url('pages/edit/' . $nav->id) }}">
					{{ $nav->title }}

					@if($nav->id == 1)
					<span>Default</span>
					@endif
				</a>
			</li>
			@endforeach
		</ul>
		@else
			<span class="empty-state">No pages yet</span>
		@endif
	</div>

	{{ Form::open(['class' => 'primary']) }}
		@if(isset($msg))
		<div class="msg">
			<div class="wrap">{{ $msg }}</div>
		</div>
		@endif

		@if(isset($error))
		<div class="error">
			<div class="wrap">{{ $error }}</div>
		</div>
		@endif

		<div class="wrap">
			<h2>Editing Page “{{ $page->title }}”</h2>

			<p>
				{{ Former::text('title')->label('Page title')->required() }}
				<em class="help">What should your page be called?</em>
			</p>

			<p>
				{{ Former::code_text('slug')->label('Page slug')->data_slugify('#title')->required() }}
				<em class="help">
					This will be displayed as <code>/pages/<span data-slugify="#title">{{ Input::get('slug') }}</span></code>.
				</em>
			</p>

			<p>
				{{ Former::textarea('content')->label('Page content') }}
				<em class="help">The main body of your page. Accepts HTML.</em>
			</p>

			{{ Former::button('Update Page')->type('submit') }}

			@if($page->id > 1)
			<a href="{{ admin_url('pages/delete/' . $page->id) }}" class="btn negative">Delete Page</a>
			@endif
		</div>
	{{ Form::close() }}
@stop