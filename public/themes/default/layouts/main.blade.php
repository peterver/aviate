<!DOCTYPE html>
<html lang="en" class="no-js">
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
			<meta name="google-analytics" content="{{ $site->google_analytics }}">
		@endif

		<link rel="icon" type="image/x-icon" href="{{ asset_url('favicon.png') }}">

		{{ stylesheet() }}

		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js"></script>
	</head>
	
	<body class="{{ $class or '' }}">

		<section id="site-top">
			<nav class="site-nav">
				@foreach(Page::visible() as $page)
				<a {{ $page->className or '' }} href="{{ URL::to('pages/' . $page->slug) }}">{{ $page->title }}</a>
				@endforeach
			</nav>

			{{ Form::open(array('url' => 'search')) }}
				<input type="search" placeholder="Search {{ site_name() }}&hellip;" name="query">
				<button type="submit" class="hidden">Submit query</button>
			{{ Form::close() }}
		</section>

		<header id="site-header">
			<div class="wrap">
				<a class="site-logo" href="{{ URL::to('/') }}" title="Click to go back to the homepage">
					<!-- {{ site_name() }} -->
					{{ theme_asset('aviate-logo.png', 'Aviate CMS logo', array('width' => 93, 'height' => 19)) }}
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
			<small>&copy; {{ date('Y') }} {{ site_name() }}. All rights reserved.</small>

			<!-- You can remove this if you really want to :( -->
			<a target="_blank" class="attribution" href="//aviatecms.com">
				Powered by {{ theme_asset('aviate-logo.png', 'Aviate CMS logo') }}
			</a>
		</footer>

		<script>
			document.documentElement.className = 'js';

			var products = document.querySelector('.products');

			if(products) {
				new Masonry(products, {
					itemSelector: '.product',
					percentPosition: true,
					gutter: '.product-gutter'
				});
			}
	</script>

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