@extends('admin/_layout')

@section('content')
<aside class="related">
	<header>
		<a class="filter-toggle">
			{{ HTML::image(
				'bower_components/engine/svg/filter.svg',
				'Filter list',
				['class' => 'icon']
			) }}
		</a>

		<a class="btn subdued" href="/admin/users/create">New user</a>
	</header>

	<div class="filter">
		<input type="search" data-search=".list li" placeholder="Search users…">
		
		<select class="faux-small" data-attr="level" data-filter=".list li">
			<option>All</option>
			<option value="2">Admin</option>
			<option value="1">Users</option>
		</select>
	</div>

	<ul>
		@foreach($users as $user)
		<li data-attrs='{{ json_encode($user) }}'>
			<a {{ @($current->id === $user->id ? 'class="active"' : '') }} href="/admin/users/{{ $user->id }}/edit">
				<img src="/assets/img/avatar.png" class="avatar default">
				
				<b>{{ $user->name or $user->username }}</b>
				<span class="username">{{ $user->username }}</span>
			</a>
		</li>
		@endforeach
	</ul>
</aside>

<section class="primary">
	<a class="btn top-right" href="{{ admin_url('users/create') }}" class="primary">Create a new user</a>

	<p class="empty-state">
		@if(count($users) > 0)
		Please pick a user from the left to edit
		@else
		There’s no users, the sky is falling.
		@endif
	</p>
</section>
@stop