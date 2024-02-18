@php
    $pageDesc = 'Admin Dashboard for accessebility';
    $path = [['title' => 'Admin Panel', 'link' => url('admin')], ['title' => $current['page_title'], 'link' => url('')]];
@endphp
@extends('Spider::admin.assets.layout')
@push('css')
    <style>
        .components {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .component {
            border-radius: 8px;
            padding: 20px;
            box-shadow: 5px 8px 20px 0 #00000011;
        }
    </style>
@endpush
@section('main')
    <main>
        <x-Spider::page :path="$path"></x-Spider::page>
        <div class="components">
            @foreach ($components as $i => $component)
                <div class="component">
                    <h5>{{ $component['component_title'] }} <i class="text info"># {{ $component['varients_count'] }}</i>
                    </h5>
                    <div class="rflex" style="margin-top: 15px;gap:10px">
                        <a href="{{url('admin/varient/init/'.$component['id'])}}" style="color:inherit">
                            <i class="fa-solid fa-plus icon vu-btn" title="Create New Varient"></i>
                        </a>
                        <a href="" style="color:inherit">
                            <i class="fa-solid fa-edit icon vu-btn" title="Edit Base Component"></i>
                        </a>
                        <a class="vu-btn" title="View All Varients"
                            href="{{ url('admin/components/' . $component['id']) }}">Varients</a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
