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
				<li>
					<a class="flaticon feather-1" href="http://localhost:1005/admin/posts">Posts</a>
				</li>
				
				<li>
					<a class="flaticon writing-comment-2" href="http://localhost:1005/admin/comments">Comments</a>
				</li>
				
				<li>
					<a class="flaticon multiple-documents-1" href="http://localhost:1005/admin/pages">Pages</a>
				</li>
				
				<li>
					<a class="flaticon menu-list-4" href="http://localhost:1005/admin/menu">Menu</a>
				</li>
				
				<li>
					<a class="flaticon tag-1" href="http://localhost:1005/admin/categories">Categories</a>
				</li>
			</ul>
    		
    		<a class="dime-logo">Dime CMS</a>
    		
    		<ul class="results">
    			<li>
    				<a href="/">Visit site</a>
    			</li>
    			
    			<li class="active">
    				<a class="flaticon user-1" href="http://localhost:1005/admin/users">Users</a>
    			</li>
    			
    			<li>
    				<a class="flaticon cube-1" href="http://localhost:1005/admin/extend">Extensions</a>
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