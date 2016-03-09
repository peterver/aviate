@extends('admin/_layout')

@section('content')
	<div class="list secondary">
		@if(Page::all()->count())
		<ul>
			@foreach(Page::all() as $page)
			<li @if(Request::is(admin_url('pages/edit/' . $page->id))) class="active" @endif>
				<a href="{{ admin_url('pages/edit/' . $page->id) }}">
					{{ $page->title }}

					@if($page->id == 1)
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
		<h2>Create new Page</h2>

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

		{{ Former::button('Create Page')->type('submit') }}
	{{ Form::close() }}
@stop