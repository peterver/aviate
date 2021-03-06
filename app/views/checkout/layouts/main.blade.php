<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Language" content="en">

		<title>
			{{ site_name() }} &mdash; {{ $title or 'Checkout' }}
		</title>

		<meta property="og:url" content="{{ URL::to('/') }}">
		<meta property="og:site_name" content="{{ site_name() }}">
		<meta property="og:title" content="{{ $title or site_description() }}">
		<meta property="og:description" content="{{ site_description() }}">
		
		@if(isset($site->google_analytics))
			<meta name="google-analytics" content="{{ $site->google_analytics }}">
		@endif

		<link rel="icon" type="image/x-icon" href="{{ asset_url('favicon.png') }}">

		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<link rel="stylesheet" href="{{ URL::to('aviate/css/checkout.css') }}">
	</head>
	
	<body class="{{ $class or '' }}">
		<main id="site-content">
			{{ $content }}
		</main>

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