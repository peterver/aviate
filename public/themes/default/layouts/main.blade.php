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

		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
		<![endif]-->
	</head>
	
	<body class="{{ $class or '' }}">

		<header id="top" class="wrap">
			<a class="site-logo" href="{{ URL::to('/') }}" title="Click to go back to the homepage">{{ $site->name }}</a>

			<nav class="site-nav">
				<a class="categories dropdown" href="{{ URL::to('categories') }}">
					Categories

					<ul>
						@foreach(Category::all() as $category)
						<li>
							<a href="{{ URL::to('categories/' . $category->slug) }}">{{ $category->name }}</a>
						</li>
						@endforeach
					</ul>
				</a>

				@foreach(Page::visible() as $page)
				<a {{ $page->className or '' }} href="{{ URL::to('pages/' . $page->slug) }}">{{ $page->title }}</a>
				@endforeach
			</nav>

			<a class="basket" href="{{ Url::to('basket') }}">
				Your Basket
				<span>{{ Basket::itemCount() }} items, <b>£99.05</b></span>
			</a>
		</header>

		<div class="banner">
			<div class="carousel">
				<ul>
					<li>
						<a href="#">
							<h1>Be awesome for summer</h1>
							<img src="http://cdn.shopify.com/s/files/1/0261/0005/t/14/assets/slide-image-2.jpg">
						</a>
					</li>

					<li>
						<a href="#">
							<h1>Here's another slide</h1>
							<img src="http://lorempixel.com/1200/600/">
						</a>
					</li>

					<li>
						<a href="#">
							<h1>Fashionistas</h1>
							<img src="http://lorempixel.com/1200/601/">
						</a>
					</li>

					<li>
						<a href="#">
							<h1>Autumn sale now on!</h1>
							<img src="http://lorempixel.com/1200/599/">
						</a>
					</li>
				</ul>
			</div>

			{{ Form::open(array('url' => 'search')) }}
				<input type="search" placeholder="Search {{ $site->name }}&hellip;" name="query">
				<button type="submit" class="hidden">Submit query</button>
			{{ Form::close() }}
		</div>

		<main id="content">
			<header class="listing-header">
				<h1>Latest products</h1>

				<a class="rss-link" href="{{ URL::to('rss/products') }}">RSS Feed</a>
			</header>

			<ul class="">

			</ul>
		</main>
	
		@section('header')
			<header id="page-top" class="wrap">

				<div class="row quicklinks">
					{{ Form::open(array('url' => 'search')) }}
						<input type="search" placeholder="Search {{ $site->name }}&hellip;" name="query">
						<button type="submit" class="hidden">Submit query</button>
					{{ Form::close() }}

					<a id="site-name" href="{{ URL::to('/') }}" title="Click to go back to the homepage">{{ $site->name }}</a>

					<div class="right">
						<a class="-urlbasket" href="{{ Url::to('basket') }}">Basket <span>{{ Basket::itemCount() }}</span></a>

						<div class="pages">
							<a class="pages-link" href="#pages" title="Show the pages">&#x2261;</a>
						
							<ul id="pages">
								@foreach(Page::visible() as $page)
									<li {{ $page->className or '' }}>
										<a href="{{ URL::to($page->slug) }}">{{ $page->title }}</a>
									</li>
								@endforeach
							</ul>
					</div>
				</div>

				<nav class="categories">
					<ul>
						@foreach(Category::all() as $category)
						<li>
							<a href="{{ URL::to('categories/' . $category->slug) }}">{{ $category->name }}</a>
						</li>
						@endforeach
					</ul>
				</nav>

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