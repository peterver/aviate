<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Language" content="en">

		<title>
			{{ $site->name }} &mdash; {{ $title or $site->tagline }}
		</title>

		<meta property="og:url" content="{{ URL::to('/') }}">
		<meta property="og:site_name" content="{{ $site->name }}">
		<meta property="og:title" content="{{ $title or $site->tagline }}">
		<meta property="og:description" content="{{ $site->tagline }}">
		
		@if(isset($site->google_analytics))
			<meta name="google-analytics" content="$site->google_analytics">
		@endif

		<link rel="icon" type="image/x-icon" href="{{ Theme::asset('img/favicon.png') }}">

		{{ Theme::asset('style', 'css') }}
		{{ Theme::asset('mobile', 'css', array('media' => '(max-width: 1000px)')) }}

		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
		<![endif]-->
	</head>
	
	<body class="{{ $class or '' }}">
	
		@section('header')
			<header id="page-top">
				header goes here
			</header>
		@show
		
		@yield('content')
		
		@section('footer')
		<footer id="page-bottom">
			<small>dime it up yo!</small>
		</footer>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

        {{ Theme::asset('app', 'js') }}
        {{ Theme::asset('interactions', 'js') }}

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        @if(isset($site->google_analytics))
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