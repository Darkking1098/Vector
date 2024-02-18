@extends('Spider::user.assets.base_layout')

@section('styles')
    <!-- Icon Stylesheets -->
    <link rel="stylesheet" href="{{ url('icon/css/all.min.css') }}">
    <!-- Vector Stylesheets -->
    <link rel="stylesheet" href="{{ url('css/style.php') }}">
    <!-- Other Stylesheets -->
    <link rel="stylesheet" href="{{ url('css/admin/sidebar.css') }}">
    <style>
        main{
            padding:25px 30px;
        }
    </style>
    @stack('css')
@endsection

@section('body')

    <body>
        <div class="sidebar_layout">
            @include('Spider::admin.assets.sidebar')
            <div class="main_content">
                @includeIf('admin.assets.header')
                @yield('main')
                @includeIf('admin.assets.footer')
            </div>
        </div>
        @stack('other')
        <!-- Main Scripts -->
        <script src="{{ url('js/vector.js') }}"></script>
        <!-- Other Scripts -->
        @stack('js')
    </body>
@endsection
