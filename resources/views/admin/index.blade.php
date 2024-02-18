@php
    $pageDesc = 'Admin Dashboard for accessebility';
    $path = [['title' => 'Admin Panel']];
@endphp
@extends('Spider::admin.assets.layout')
@section('main')
    <main>
        <x-Spider::page :path="$path"></x-Spider::page>
    </main>
@endsection
