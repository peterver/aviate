@extends('admin/_layout')

@section('content')
	<div class="list secondary">
		@if(Category::all()->count())
		<h1><a href="{{ admin_url('categories') }}">All Categories</a></h1>

		<ul>
			@foreach(Category::all() as $category)
			<li @if(Request::is(admin_url('categories/edit/' . $category->id))) class="active" @endif>
				<a href="{{ admin_url('categories/edit/' . $category->id) }}">
					{{ $category->name }}

					@if($category->id == 1)
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

	{{ Form::open(['class' => 'tertiary']) }}
		<h2>Create new category</h2>

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

		{{ Former::button('Create category')->type('submit') }}
	{{ Form::close() }}
@stop