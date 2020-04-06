<!DOCTYPE html>
<html>
<head>
    <title>GTB2020 - @yield('title')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
        .pt-0 { padding-top: 0 !important; }
        .pb-0 { padding-bottom: 0 !important; }
        .pl-0 { padding-left: 0 !important; }
        .pr-0 { padding-right: 0 !important; }
    </style>
    @section('head')
    @show
</head>

<body>
<nav>
    <div class="nav-wrapper blue darken-2">
        <a href="#" class="brand-logo" style="margin-left: 10px;">GTB2020</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
<!--            <li><a href="sass.html">Sass</a></li>-->
        </ul>
    </div>
</nav>

<div class="container-fluid">
    @yield('content')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
@section('js')
@show
</body>
</html>

