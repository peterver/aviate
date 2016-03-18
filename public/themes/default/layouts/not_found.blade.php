<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Language" content="en">

		<title>
			{{ site_name() }} &mdash; {{ $title or site_description() }}
		</title>

		<meta property="og:url" content="{{ URL::to('/') }}">
		<meta property="og:site_name" content="{{ site_name() }}">
		<meta property="og:title" content="{{ $title or site_description() }}">
		<meta property="og:description" content="{{ site_description() }}">
		
		@if(isset($site->google_analytics))
			<meta name="google-analytics" content="$site->google_analytics">
		@endif

		<link rel="icon" type="image/x-icon" href="{{ asset_url('favicon.png') }}">

		{{ stylesheet() }}

		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
		<![endif]-->
	</head>
	
	<body class="{{ $class or 'not_found' }}">
		<main id="site-full">
			<div class="not-found-msg">
				{{ $content }}
			</div>
		</main>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

        {{ assets(['app.js', 'interactions.js']) }}

        @if(isset($site->google_analytics))
	        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        	<script>
	            (function(b,r,a,i,n,y){b.GoogleAnalyticsObject=i;b[i]||(b[i]=
	            function(){(b[i].q=b[i].q||[]).push(arguments)});b[i].l=+new Date;
	            n=r.createElement(a);y=r.getElementsByTagName(a)[0];
	            n.src='//www.google-analytics.com/analytics.js';
	            y.parentNode.insertBefore(n,y)}(window,document,'script','ga'));
	            ga('create','{{ $site->google_analytics }}');ga('send','pageview');
	        </script>
		@endif
    </body>
</html>