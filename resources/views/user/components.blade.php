@php
    $path = [['title' => 'Components', 'link' => url('components')]];
@endphp
@extends('user.assets.layout')
@push('css')
    <style>
        .page_details {
            padding: 30px 35px 0;
        }

        .components {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            padding: 10px 30px;
            gap: 20px;
        }

        .component {
            padding: 20px;
            box-shadow: 5px 8px 20px 0 #00000022;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
        }

        .component .component_desc {
            font-size: 0.8em;
            font-weight: 600;
            color: var(--gray_600);
            margin-block: 6px 8px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
    </style>
@endpush
@section('main')
    <main>
        <div class="page_details">
            <h1>Explore Components</h1>
            <x-breadcrumb :path="$path"></x-breadcrumb>
        </div>
        <div class="components">
            @foreach ($components as $component)
                <div class="component">
                    <h5 class="component_title">{{ $component['component_title'] }}</h5>
                    <p class="component_desc">{{ $component['component_desc'] }}</p>
                    <i class="badge info bg-info ass">{{ $component['varients_count'] }} Varient Available</i>
                    <a href="{{ $component['web_page']['webpage_slug'] }}" class="vu-btn">View All</a>
                </div>
            @endforeach
        </div>
    </main>
@endsection
