<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Language" content="en">

		<title>
			{{ get_site_name() }} &mdash; {{ $title or get_site_description() }}
		</title>

		<meta property="og:url" content="{{ URL::to('/') }}">
		<meta property="og:site_name" content="{{ get_site_name() }}">
		<meta property="og:title" content="{{ $title or get_site_description() }}">
		<meta property="og:description" content="{{ get_site_description() }}">
		
		@if(isset($site->google_analytics))
			<meta name="google-analytics" content="$site->google_analytics">
		@endif

		<link rel="icon" type="image/x-icon" href="{{ get_asset_url('favicon.png') }}">

		{{ get_stylesheet() }}

		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
		<![endif]-->
	</head>
	
	<body class="{{ $class or '' }}">

		<section id="site-top">
			<nav class="site-nav">
				@foreach(Page::visible() as $page)
				<a {{ $page->className or '' }} href="{{ URL::to('pages/' . $page->slug) }}">{{ $page->title }}</a>
				@endforeach
			</nav>

			{{ Form::open(array('url' => 'search')) }}
				<input type="search" placeholder="Search {{ get_site_name() }}&hellip;" name="query">
				<button type="submit" class="hidden">Submit query</button>
			{{ Form::close() }}
		</section>

		<header id="site-header">
			<div class="wrap">
				<a class="site-logo" href="{{ URL::to('/') }}" title="Click to go back to the homepage">
					{{ get_site_name() }}
					<!-- {{ get_asset('aviate-logo.png', 'Aviate CMS logo', array('width' => 93, 'height' => 19)) }} -->
				</a>
				
				<nav class="site-categories">
					@foreach(Category::all() as $category)
						<a @if(Request::segment(1) == $category->slug) class="active" @endif href="{{ URL::to($category->slug) }}">
							{{ $category->name }}
						</a>
					@endforeach
				</nav>

				<a class="basket {{ Basket::itemCount() > 0 ? 'has-items' : 'empty' }}" href="{{ Url::to('basket') }}">
					<span>{{ Basket::itemCount() }}</span> <b>{{ Basket::priceCount() }}</b>
				</a>
			</div>
		</header>

		<main id="site-content">
			{{ $content }}
		</main>
		
		<footer id="site-footer">
			<small>&copy; {{ date('Y') }} {{ get_site_name() }}. All rights reserved.</small>

			<!-- You can remove this if you really want to :( -->
			<a target="_blank" class="attribution" href="//aviatecms.com">
				Powered by {{ get_asset('aviate-logo.png', 'Aviate CMS logo') }}
			</a>
		</footer>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

        {{ get_assets(['app.js', 'interactions.js']) }}

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