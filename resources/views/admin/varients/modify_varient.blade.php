@php
    $pageDesc = 'Admin Dashboard for accessebility';
    $path = [['title' => 'Admin Panel', 'link' => url('admin')], ['title' => 'Components', 'link' => url('admin/components')], ['title' => $current['page_title']]];
@endphp
@extends('Spider::admin.assets.layout')
@push('css')
    <link rel="stylesheet" href="{{ url('css/admin/form.css') }}">
@endpush
@section('main')
    <main>
        <x-Spider::page :path="$path" :pageDesc="$pageDesc"></x-Spider::page>
    </main>
@endsection
