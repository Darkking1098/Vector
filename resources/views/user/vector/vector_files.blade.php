@php
    $path = [['title' => 'Vector Files']];
@endphp
@extends('user.assets.layout')
@push('css')
    <style>
        .files {
            padding: 40px 30px ;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .file .code {
            padding: 10px 10px 10px 20px;
            font-weight: 600;
            border-radius: 6px;
            margin-top: 10px;
            background: var(--gray_200);
            display: flex;
            justify-content: space-between
        }

        .file .code i {
            width: 21px;
        }
    </style>
@endpush
@section('main')
    <main>
        <div class="page_details">
            <h1>Attach Vector Files</h1>
            <x-breadcrumb :path="$path"></x-breadcrumb>
        </div>
        <div class="files">
            <a href="{{ url('vector/customize') }}">You can also customize files as requirment</a>
            <div class="file">
                <h4>Vector Logo</h4>
                <div class="code">
                    <span id="vi">{{ url('images/web assets/logo.png') }}</span>
                    <i class="icon fa-solid fa-clone v-copy" data-copy="vi"></i>
                </div>
            </div>
            <div class="file">
                <h4>Vector Css</h4>
                <div class="code">
                    <span id="vc">{{ url('css/vector.css') }}</span>
                    <i class="icon fa-solid fa-clone v-copy" data-copy="vc"></i>
                </div>
            </div>
            <div class="file">
                <h4>Vector Js</h4>
                <div class="code">
                    <span id="vj">{{ url('js/vector.js') }}</span>
                    <i class="icon fa-solid fa-clone v-copy" data-copy="vj"></i>
                </div>
            </div>
            <div class="file">
                <h4>Font Awosome</h4>
                <div class="code">
                    <span id="fa">{{ url('icons/css/all.min.css') }}</span>
                    <i class="icon fa-solid fa-clone v-copy" data-copy="fa"></i>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
    <script>
        $('.v-copy').VU.perform((x) => {
            x.node.addEventListener('click', () => {
                var copyText = $(`#${x.get('data-copy')}`).innerText;
                navigator.clipboard.writeText(copyText);
                alert("Copied the text: " + copyText);
            })
        });
    </script>
@endpush
