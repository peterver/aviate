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
        {{ HTML::style('aviate/css/admin-small.css', array('media' => '(max-width: 1200px)')) }}
        
        <!-- Compiles from current theme, if it exists -->
        {{ HTML::style('themes/' . Metadata::item('theme') . '/admin-custom.css') }}
    </head>
    <body>
    	<div class="frame">
            <nav class="main-nav">
                <a class="logo" href="{{ admin_url() }}">
                    {{ HTML::image('aviate/aviate-logo.png', 'Aviate CMS logo', ['width' => 23, 'height' => 19]) }}      
                </a>

    			<ul class="actions">
                    @foreach($pages as $page)
                    <li class="{{ Request::segment(2) === $page ? 'active' : '' }}">
                        <a class="icon-generic icon-{{ $page }}" href="{{ admin_url($page) }}">{{ ucwords($page) }}</a>
                    </li>
                    @endforeach
    			</ul>
        		
        		<ul class="results">
        			<li><a class="icon-visit-site" href="{{ URL::to('/') }}">Visit site</a></li>
                    @foreach($results as $result => $url)
                    <li class="{{ strpos(Request::url(), $url) !== false ? 'active' : '' }}">
                        <a class="icon-generic icon-{{ str_replace(admin_path(''), '', $url) }}" href="{{ URL::to($url) }}">{{ $result }}</a>
                    </li>
                    @endforeach
        		</ul>

                <small>{{ $welcome_message }}</small>
        	</nav>

        	<section class="content">
                @if(isset($msg))
                <div class="msg">
                    <div class="wrap">{{ $msg }}</div>
                </div>
                @endif

                @if(isset($error))
                <div class="error">
                    <div class="wrap">{{ $error }}</div>
                </div>
                @endif

                @yield('content')
            </section>
        </div>

		<!-- JS wankery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{ URL::to('aviate/js/jquery.min.js') }}"><\/script>')</script>

        {{ HTML::script('aviate/js/main.js') }}
        
        @yield('scripts')
    </body>
</html>