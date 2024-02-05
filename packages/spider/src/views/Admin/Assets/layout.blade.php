<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('css/vector.css') }}">
    <link rel="stylesheet" href="{{ url('vector/spider/css/admin/sidebar.css') }}">
    <link rel="stylesheet" href="{{ url('vector/spider/css/admin/theme.css') }}">
    @stack('css')
</head>

<body>
    <div class="sidebar_layout">
        @include('Spider::Admin.Assets.sidebar')
        <div class="main_content">
            @include('Spider::Admin.Assets.header')
            @yield('main')
            @include('Spider::Admin.Assets.footer')
        </div>
    </div>
    <script src="{{url('js/vector.js')}}"></script>
    @stack('js')
</body>

</html>
