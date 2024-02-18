@php
    $pageDesc = 'Admin Dashboard for accessebility';
    $path = [['title' => 'Admin Panel', 'link' => url('admin')], ['title' => 'Components', 'link' => url('admin/components')], ['title' => $current['page_title']]];
@endphp
@extends('Spider::admin.assets.layout')
@push('css')
    <link rel="stylesheet" href="{{ url('css/admin/form.css') }}">
    <style>
        .code {
            padding: 10px 10px 10px 20px;
            font-weight: 600;
            border-radius: 6px;
            margin-top: 10px;
            font-size: 0.8em;
            background: var(--gray_200);
            display: flex;
            justify-content: space-between;
        }

        section {
            margin-top: 30px
        }

        .preview {
            margin: 60px;
            display: flex;
            justify-content: center;
        }

        {!! $component['component_css'] !!}
    </style>
@endpush
@section('main')
    <main>
        <x-Spider::page :path="$path" :pageDesc="$pageDesc"></x-Spider::page>
        <div class="preview">{!! $component['component_html'] !!}</div>
        <section>
            <h6>Base HTML Code <i class="badge bg-prime prime">Modify Accordingly</i></h6>
            <div class="code"><span>{{ $component['component_html'] }}</span> <i class="fa-solid fa-clone"></i></div>
        </section>
        <section>
            <h6>Base CSS Code <i class="badge bg-error error">Don't Change it</i></h6>
            <div class="code"><span>{{ $component['component_css'] }}</span> <i class="fa-solid fa-clone"></i></div>
        </section>
        <section>
            <h6>Base Js Code <i class="badge bg-error error">Don't Change it</i></h6>
            <div class="code"><span>{{ $component['component_js'] }}</span> <i class="fa-solid fa-clone"></i></div>
        </section>
    </main>
@endsection
@push('js')
    <script>
        {!! $component['component_js'] !!}
    </script>
@endpush
