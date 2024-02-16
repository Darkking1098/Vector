@php
    $path = [['title' => 'Conventions']];
@endphp
@extends('user.assets.layout')
@push('css')
    <style>
        ul {
            margin: 20px;
        }

        li {
            padding: 5px;
        }

        code {
            background: var(--gray_200);
            font-size: 0.8em;
            padding: 1px 10px;
            border-radius: 4px;
            display: inline-block;
            font-weight: 600;
        }

        .conventions {
            padding: 40px 30px;
        }

        .process {
            padding: 0px 30px;
        }
    </style>
@endpush
@section('main')
    <main>
        <div class="page_details">
            <h1>Naming Conventions</h1>
            <x-breadcrumb :path="$path"></x-breadcrumb>
        </div>
        <div class="conventions">
            <h5>Naming Conventions that must be follwed by developer</h5>
            <ul>
                <li>Every component must be wrapped in a tag.</li>
                <li>Class names of every component must be started by <code>vu-</code>. Example: <code>vu-btn</code>
                    <code>vu-input</code></li>
                <li>If you want to add any functionality you should use <code>v-</code>. Example: <code>v-drag</code>
                    <code>v-dark</code> <code>v-exand</code></li>
                <li>Use - while using with VU or V else use _ for naming. Example: <code>vu-input</code>
                    <code>vu-calander</code> <code>field_group</code></li>
            </ul>
        </div>
        <div class="process">
            <h5>Process to contribute</h5>
            <ul>
                <li>Choose a component to create your varient.</li>
                <li>Register/login before continue.</li>
                <li>Init your component and get a unique classname for your component to avoid conflicts.</li>
                <li>Basic template will also be provided to continue.</li>
                <li>Use unique class name to define your css and js</li>
                <li>You can modify html template provided as you required.</li>
            </ul>
        </div>
    </main>
@endsection
