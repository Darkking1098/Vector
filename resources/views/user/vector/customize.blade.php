@php
    $path = [['title' => 'Vector Files', 'link' => url('vector')], ['title' => 'Customize Files', 'link' => url('vector/customize')]];
@endphp
@extends('user.assets.layout')
@push('css')
    <style>
        a.vu-btn{
            background: var(--info);
            color: white;
        }
    </style>
@endpush
@section('main')
    <main>
        <div class="page_details">
            <h1>Customize Vector Files</h1>
            <x-breadcrumb :path="$path"></x-breadcrumb>
        </div>
        <div class="files rflex jcc" style="gap:20px;margin-top:40px">
            <a href="{{ url('vector/customize/css') }}" class="vu-btn">Css File</a>
            <a href="{{ url('vector/customize/js') }}" class="vu-btn">Js File</a>
        </div>
    </main>
@endsection
