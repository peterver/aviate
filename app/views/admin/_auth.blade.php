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
        {{ HTML::style('aviate/js/pen/pen.css') }}
        
        <!-- Compiles from current theme, if it exists -->
        {{ HTML::style('themes/' . Metadata::item('theme') . '/admin-custom.css') }}
    </head>
    <body>
    	@yield('content')

		<!-- JS wankery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

        {{ HTML::style('aviate/js/plugins.js') }}
        {{ HTML::style('aviate/js/main.js') }}
    </body>
</html>