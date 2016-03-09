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

    <body class="{{ $class or 'dashboard' }}">
        <header id="top">
            <nav class="top-bar split">
                <a class="logo centred" href="{{ admin_url() }}">
                    {{ HTML::image('bower_components/engine/svg/plane.svg', 'Aviate CMS logo', ['class' => 'icon', 'width' => 23, 'height' => 19]) }}      
                </a>

                <ul class="actions">
                    @foreach($pages as $page)
                    <li class="{{ Request::segment(2) === $page ? 'active' : '' }}">
                        <a href="{{ admin_url($page) }}" title="{{ ucwords($page) }}">
                            {{ HTML::image('bower_components/engine/svg/' . $page . '.svg', ucwords($page), ['class' => 'icon']) }}

                            {{ ucwords($page) }}
                        </a>
                    </li>
                    @endforeach

                    <li class="has-dropdown">
                        <a href="{{ admin_url('plugins') }}">
                            {{ HTML::image('bower_components/engine/svg/plugins.svg') }}

                            Plugins
                        </a>

                        <ul class="dropdown">
                            @foreach($plugins as $slug => $opts)
                                <li>
                                    <a href="{{ admin_url($slug) }}">
                                        {{ HTML::image('bower_components/engine/svg/' . fallback(@$opts['icon'], 'generic') . '.svg') }}

                                        {{ $opts['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

                <ul class="results">
                    <li>
                        <a class="icon-visit-site" title="Visit site" href="{{ URL::to('/') }}">
                            {{ HTML::image('bower_components/engine/svg/globe.svg', 'Visit site', ['class' => 'icon']) }}

                            Visit site
                        </a>
                    </li>
                    @foreach($results as $result => $url)
                    <li class="{{ strpos(Request::url(), $url) !== false ? 'active' : '' }}">
                        <a title="{{ $result }}" href="{{ URL::to($url) }}">
                            {{ HTML::image('bower_components/engine/svg/' . str_replace(admin_path(''), '', $url) . '.svg', $result, ['class' => 'icon']) }}

                            {{ $result }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </nav>
        </header>


        <main>
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
        </main>

        <footer class="bottom-bar wrap">
            <small class="align-left">Powered by Aviate {{ Metadata::version() }}.</small>

            <small class="align-right">{{ $welcome_message }}</small>
        </footer>

		<!-- JS wankery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{ URL::to('aviate/js/jquery.min.js') }}"><\/script>')</script>

        {{ HTML::script('bower_components/svg-injector/svg-injector.js') }}
        {{ HTML::script('bower_components/engine/js/engine.min.js') }}
        {{ HTML::script('aviate/js/main.js') }}

        @yield('scripts')
    </body>
</html>