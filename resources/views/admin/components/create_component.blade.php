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
        <form action="{{url($current['current_url'])}}" method="post">
            <div class="hidden">
                @csrf
            </div>
            <section class="panel">
                <div class="field_group">
                    <div class="field">
                        <label>Component Title</label>
                        <input type="text" name="component_title">
                    </div>
                    <div class="field">
                        <label>Component Class</label>
                        <input type="text" name="component_class">
                    </div>
                </div>
                <div class="field">
                    <label>Component Description</label>
                    <input type="text" name="component_desc">
                </div>
            </section>
            <section>
                <div class="field">
                    <label>Component Base HTML</label>
                    <textarea name="component_html"></textarea>
                </div>
            </section>
            <section>
                <div class="field">
                    <label>Component Base CSS</label>
                    <textarea name="component_css"></textarea>
                </div>
            </section>
            <section>
                <div class="field">
                    <label>Component Base JS</label>
                    <textarea name="component_js"></textarea>
                </div>
            </section>
            <button type="submit" class="vu-btn">Get Template</button>
        </form>
    </main>
@endsection
