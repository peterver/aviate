<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <title>You’re installing Aviate CMS!</title>
        
        <meta name="description" content="">
        <meta name="viewport" content="width=1400, initial-scale=1">

		<!-- Compiles from LESS -->
        {{ HTML::style('bower_components/engine/css/engine.css'); }}
        {{ HTML::style('aviate/css/install.css'); }}
    </head>
    <body>
    	<section class="frame">
            <aside>
                {{ HTML::image('aviate/aviate-logo.png', 'Aviate CMS', ['class' => 'logo', 'width' => 23, 'height' => 19]) }}

                @yield('aside')
            </aside>
        	
            @if(isset($error))
                <div class="error">{{ $error }}</div>
            @endif

            <main>@yield('content')</main>
        </section>
        
		<!-- JS wankery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{ URL::to('aviate/js/jquery.min.js') }}"><\/script>')</script>

        {{ HTML::script('aviate/js/main.js') }}
		</script>
    </body>
</html>