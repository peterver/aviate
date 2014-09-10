<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <title>Dime CMS</title>
        
        <meta name="description" content="">
        <meta name="viewport" content="width=1400, initial-scale=1">

		<!-- Compiles from LESS -->
        {{ HTML::style('dime/css/admin.css'); }}
        {{ HTML::style('dime/js/pen/pen.css'); }}
        
        <!-- Compiles from current theme, if it exists -->
        {{ HTML::style('themes/' . $theme . '/admin-custom.css'); }}
    </head>
    <body>
    	<nav class="main-nav">
			<ul class="actions">
                @foreach($pages as $page)
                <li class="{{ Request::is('admin/' . $page) ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/' . $page) }}">{{ ucwords($page) }}</a>
                </li>
                @endforeach
			</ul>
    		
    		<a class="dime-logo">Dime CMS</a>
    		
    		<ul class="results">
    			<li>
    				<a href="{{ URL::to('/') }}">Visit site</a>
    			</li>
    			
    			<li class="active">
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
    	
    	@yield('content')
        

		<!-- JS wankery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
		</script>
    </body>
</html>