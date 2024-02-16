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
        <div class="sidebar_layout">
            <div class="sidebar"></div>
            <div class="main_content">
                @includeIf('user.assets.header')
                @yield('main')
                @includeIf('user.assets.footer')
            </div>
        </div>
        @stack('other')
        <!-- Main Scripts -->
        <script src="http://localhost:5958/js/vector.js"></script>
        <!-- Other Scripts -->
    </body>
@endsection
