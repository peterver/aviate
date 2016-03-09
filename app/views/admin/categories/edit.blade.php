@extends('admin/_layout')

@section('content')
	<div class="list secondary">
		@if(Category::all()->count())
		<ul>
			@foreach(Category::all() as $nav)
			<li @if(Request::is(admin_path('categories/edit/' . $nav->id))) class="active" @endif>
				<a href="{{ admin_url('/categories/edit/' . $nav->id) }}">
					{{ $nav->name }}

					@if($nav->id == 1)
					<span>Default</span>
					@endif
				</a>
			</li>
			@endforeach
		</ul>
		@else
			<span class="empty-state">No categories yet</span>
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
			<h2>Editing category “{{ $category->name }}”</h2>

			<p>
				{{ Former::text('name')->label('Category name')->required() }}
				<em class="help">What should your category be called?</em>
			</p>

			<p>
				{{ Former::code_text('slug')->label('Category slug')->data_slugify('#name')->required() }}
				<em class="help">
					This will be displayed as <code>/categories/<span data-slugify="#name">{{ Input::get('slug') }}</span></code>.
				</em>
			</p>

			<p>
				{{ Former::textarea('description')->label('Category description') }}
				<em class="help">May be used in a theme, does get used in search results.</em>
			</p>

			{{ Former::button('Update category')->type('submit') }}

			@if($category->id > 1)
			<a href="{{ admin_url('categories/delete/' . $category->id) }}" class="btn negative">Delete category</a>
			@endif
		</div>
	{{ Form::close() }}
@stop