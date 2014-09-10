@extends('admin.layout')

@section('content')
<section class="filter wrap narrow">
	<input type="search" placeholder="Search users…">
	
	<select>
		<option>All users</option>
		<option>Administrators</option>
		<option>Editors</option>
		<option>Users</option>
	</select>
	
	<a class="btn primary" href="{{ URL::to('admin/users/new') }}" class="primary">Create a new user</a>
</section>

<section class="panel wrap narrow drilldown">
	@if(count($users) > 0)
	<ol>
		@foreach ($users as $user)
		<li>
			<a href="user.html">
				<img class="avatar" src="//s3.amazonaws.com/uifaces/faces/twitter/idiot/73.jpg">
				
				<span class="user-name">
					<b class="realname">{{ $user->name }} <span class="badge admin">Admin</span></b>
					<span class="username">{{ $user->username }}</span>
				</span>
				
				<ul>
					<li>{{ $user->email }}</li>
					<li>{{ $user->status }}</li>
				</ul>
			</a>
		</li>
		@endforeach
	</ol>
	@else
	<p class="empty-state">
		There’s no users, the sky is falling.
	</p>
	@endif
</section>
@stop