<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <title>{{ $title or 'Aviate CMS' }}</title>
        
        <meta name="description" content="">
        <meta name="viewport" content="width=1400, initial-scale=1">

		<!-- Compiles from LESS -->
        {{ HTML::style('aviate/css/admin.css') }}
        {{ HTML::style('aviate/js/pen/pen.css') }}
        
        <!-- Compiles from current theme, if it exists -->
        {{ HTML::style('themes/' . Metadata::item('theme') . '/admin-custom.css') }}
    </head>
    <body>
    	<div class="frame">
            <nav class="main-nav">
                <a class="logo">
                    {{ HTML::image('aviate/aviate-logo.png', 'Aviate CMS logo', ['width' => 23, 'height' => 19]) }}      
                </a>

    			<ul class="actions">
                    @foreach($pages as $page)
                    <li class="{{ Request::segment(2) === $page ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/' . $page) }}">{{ ucwords($page) }}</a>
                    </li>
                    @endforeach
    			</ul>
        		
        		<ul class="results">
        			<li>
        				<a href="{{ URL::to('/') }}">Visit site</a>
        			</li>
        			
        			<li>
        				<a class="flaticon user-1" href="{{ URL::to('admin/users') }}">Users</a>
        			</li>
        			
        			<li>
        				<a class="flaticon cube-1" href="{{ URL::to('admin/settings') }}">Settings</a>
        			</li>
        			
        			<li>
        				<a href="/admin/logout">Logout</a>
        			</li>
        		</ul>
        	</nav>
        	
        	<section class="content">
                @yield('content')
            </section>
        </div>

		<!-- JS wankery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

        {{ HTML::style('aviate/js/plugins.js') }}
        {{ HTML::style('aviate/js/main.js') }}
    </body>
</html>