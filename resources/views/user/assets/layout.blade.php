@extends('Spider::user.assets.base_layout')

@section('styles')
    <!-- Icon Stylesheets -->
    <link rel="stylesheet" href="{{ url('icon/css/all.min.css') }}">
    <!-- Vector Stylesheets -->
    <link rel="stylesheet" href="{{ url('css/style.php') }}">
    <!-- Other Stylesheets -->
    <style>
        .page_details {
            padding: 30px 35px 0;
        }
    </style>
    @stack('css')
@endsection

@section('body')

    <body>
        @includeIf('user.assets.header')
        @yield('main')
        @includeIf('user.assets.footer')
        @stack('other')
        <!-- Main Scripts -->
        <script src="{{ url('js/vector.js') }}"></script>
        <!-- Other Scripts -->
        @stack('js')
    </body>
@endsection
