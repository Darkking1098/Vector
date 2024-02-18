@php
    $path = [['title' => 'Components', 'link' => url('components')],['title' => $component['component_title']]];
@endphp
@extends('user.assets.layout')
@push('css')
    <style>
        .varients {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            padding: 10px 30px;
            gap: 20px;
        }

        .varient {
            padding: 20px;
            box-shadow: 5px 8px 20px 0 #00000022;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
        }

        .varient .varient_desc {
            font-size: 0.8em;
            font-weight: 600;
            color: var(--gray_600);
            margin-block: 6px 8px;
        }

        a.vu-btn {
            background: var(--prime);
            color: white;
            transition: all 0.2s;
            padding: 7px 20px;
            margin-top: 10px;
        }

        a.vu-btn:hover {
            background: var(--prime_dark);
        }

        .varient_preview {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 0;
        }
    </style>
@endpush
@push('js')
    @stack('comp_ss')
@endpush
@section('main')
    <main>
        <div class="page_details">
            <h1>Explore varients</h1>
            <x-breadcrumb :path="$path"></x-breadcrumb>
        </div>
        <div class="varients">
            @foreach ($component['varients'] as $varient)
                @push('css')
                    <style>
                        {{ $varient['varient_css'] }}
                    </style>
                @endpush
                <div class="varient">
                    <div class="varient_preview">
                        {!! $varient['varient_html'] !!}
                    </div>
                    <div class="varient_details">
                        <h5 class="varient_title">{{ $varient['varient_title'] }}</h5>
                        <p class="varient_desc">{{ $varient['varient_desc'] }}</p>
                        <a href="" class="vu-btn">View All</a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
