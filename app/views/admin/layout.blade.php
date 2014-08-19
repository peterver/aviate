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
    	
    	<section class="filter wrap narrow">
    		<input type="search" placeholder="Search users…">
    		
    		<select>
    			<option>All users</option>
    			<option>Administrators</option>
    			<option>Editors</option>
    			<option>Users</option>
    		</select>
    		
    		<button class="primary">Create a new user</button>
    	</section>
    	
    	<section class="panel wrap narrow drilldown">
    		<ol>
    			<li>
    				<a href="user.html">
    					<img class="avatar" src="//s3.amazonaws.com/uifaces/faces/twitter/idiot/73.jpg">
    					
    					<span class="user-name">
    						<b class="realname">Visual Idiot <span class="badge admin">Admin</span></b>
    						<span class="username">idiot</span>
    					</span>
    					
    					<ul>
    						<li>21 posts</li>
    						<li>idiot@codin.co</li>
    						<li>Active user</li>
    					</ul>
    				</a>
    			</li>
    			
    			<li>
    				<a href="user.html">
    					<img class="avatar" src="//s3.amazonaws.com/uifaces/faces/twitter/idiot/73.jpg">
    					
    					<span class="user-name">
    						<b class="realname">Visual Idiot <span class="badge admin">Admin</span></b>
    						<span class="username">idiot</span>
    					</span>
    					
    					<ul>
    						<li>21 posts</li>
    						<li>idiot@codin.co</li>
    						<li>Active user</li>
    					</ul>
    				</a>
    			</li>
    			
    			<li>
    				<a href="user.html">
    					<img class="avatar" src="//s3.amazonaws.com/uifaces/faces/twitter/idiot/73.jpg">
    					
    					<span class="user-name">
    						<b class="realname">Visual Idiot <span class="badge admin">Admin</span></b>
    						<span class="username">idiot</span>
    					</span>
    					
    					<ul>
    						<li>21 posts</li>
    						<li>idiot@codin.co</li>
    						<li>Active user</li>
    					</ul>
    				</a>
    			</li>
    			
    			<li>
    				<a href="user.html">
    					<img class="avatar" src="//s3.amazonaws.com/uifaces/faces/twitter/idiot/73.jpg">
    					
    					<span class="user-name">
    						<b class="realname">Visual Idiot <span class="badge admin">Admin</span></b>
    						<span class="username">idiot</span>
    					</span>
    					
    					<ul>
    						<li>21 posts</li>
    						<li>idiot@codin.co</li>
    						<li>Active user</li>
    					</ul>
    				</a>
    			</li>
    		</ol>
    	</section>
        

		<!-- JS wankery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
		</script>
    </body>
</html>