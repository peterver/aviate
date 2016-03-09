@extends('admin/_layout')

@section('content')
<section class="secondary">
	<div class="filter">
		<input type="search" data-search=".list li" placeholder="Search users…">
		
		<select class="faux-small" data-attr="level" data-filter=".list li">
			<option>All</option>
			<option value="2">Admin</option>
			<option value="1">Users</option>
		</select>
	</div>

	<ul class="list">
		@foreach($users as $user)
		<li data-attrs='{{ json_encode($user) }}'>
			<a href="{{ admin_url('users/edit/' . $user->id) }}">
				{{ $user->name or $user->username }}

				<small>{{ $user->email }}</small>
			</a>
		</li>
		@endforeach
	</ul>
</section>

<section class="primary">
	<a class="btn primary top-right" href="{{ admin_url('users/create') }}" class="primary">Create a new user</a>

	<p class="empty-state">
		@if(count($users) > 0)
		Please pick a user from the left to edit
		@else
		There’s no users, the sky is falling.
		@endif
	</p>
</section>
@stop