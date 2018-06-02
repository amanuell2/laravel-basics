<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>  @yield ('title')</title>

    <link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{URL::to('css/main.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/responsive.css')}}">
    <script defer src="{{asset('/static/fontawesome/svg-with-js/js/fontawesome-all.js')}}"></script>
    {{--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">--}}
    {{--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">--}}
</head>
<body>
@include('includes.header')
<div class="container">
    @yield('content')

</div>

<div>
    @yield('clear')
</div>
@include('includes.footer')
<script src="{{URL::to('js/jQuery-2.1.4.min.js')}}" type="text/javascript"></script>
<script src="{{URL::to('js/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{URL::to('js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{URL::to('js/apps.js')}}" type="text/javascript"></script>

<div>
    @yield('exceptions')
</div>
</body>
</html>
