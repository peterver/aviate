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
		@foreach($users as $item)
		<li data-attrs='{{ json_encode($item) }}'>
			<a href="{{ admin_url('users/edit/' . $item->id) }}">
				{{ $item->name or $item->username }}

				<small>{{ $item->email }}</small>
			</a>
		</li>
		@endforeach
	</ul>
</section>

<section class="tertiary">
	{{ Form::open() }}
		<h1>Creating a new user</h1>
		
		<p>
			{{ Former::text('name') }}
			<em class="help">The user’s real name.</em>
		</p>

		@if(User::is('admin'))
		<p class="multi">
			<label for="username">User/pass</label>
			<input id="username" name="username" value="{{ Input::get('username', $user->username) }}" placeholder="Username">
			<input id="password" name="password" type="password" placeholder="Password">
			<em class="help">The user’s credentials. Please don't change these without their permission! Leave password blank to keep unchanged.</em>
		</p>
		@endif

		<p>
			{{ Former::email('email') }}
			<em class="help">The user’s email address. Used to log-in in place of a username.</em>
		</p>

		@if(User::is('admin'))
		<p>
			<label for="level">Role</label>
			<select id="level" name="level">
			@foreach(User::$levels as $id => $level)
				<option @if($user->level === $id) selected @endif value="{{ $id }}">{{ ucwords($level) }}</option>
			@endforeach
			</select>
			<em class="help">What should the user be allowed to do?</em>
		</p>
		@endif

		<button type="submit">Save user</button>
	{{ Form::close() }}
</section>
@stop