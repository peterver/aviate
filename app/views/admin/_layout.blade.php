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
        
        <!-- Compiles from current theme, if it exists -->
        {{ HTML::style('themes/' . Metadata::item('theme') . '/admin-custom.css') }}
    </head>
    <body>
    	<div class="frame">
            <nav class="main-nav">
                <a class="logo" href="{{ URL::to('admin') }}">
                    {{ HTML::image('aviate/aviate-logo.png', 'Aviate CMS logo', ['width' => 23, 'height' => 19]) }}      
                </a>

    			<ul class="actions">
                    @foreach($pages as $page)
                    <li class="{{ Request::segment(2) === $page ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/' . $page) }}">{{ ucwords($page) }}</a>
                    </li>
                    @endforeach
    			</ul>
        		
        		<ul class="results">
        			@foreach($results as $url => $result)
                    <li class="{{ Request::is($url) ? 'active' : '' }}">
                        <a href="{{ URL::to($url) }}">{{ $result }}</a>
                    </li>
                    @endforeach
        		</ul>

                <small>{{ $welcome_message }}</small>
        	</nav>

            @if(isset($error))
        	<div class="error">
                {{ var_dump($error) }}
            </div>
            @endif

        	<section class="content">
                @yield('content')
            </section>
        </div>

		<!-- JS wankery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

        {{ HTML::script('aviate/js/main.js') }}
        
        @yield('scripts')
    </body>
</html>