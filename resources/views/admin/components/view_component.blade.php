@php
    $pageDesc = 'Admin Dashboard for accessebility';
    $path = [['title' => 'Admin Panel', 'link' => url('admin')], ['title' => 'Components', 'link' => url('admin/components')], ['title' => $component['component_title']]];
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
        .component i:hover{
            background: rgba(var(--bg),0.7);
            color: white;
        }
    </style>
@endpush
@section('main')
    <main>
        <x-Spider::page :path="$path"></x-Spider::page>
        <div class="components">
            @foreach ($component['varients'] as $i => $varient)
                @push('css')
                    <style>
                        {{ $varient['varient_css'] }}
                    </style>
                @endpush
                @push('js')
                    <script>
                        {{ $varient['varient_js'] }}
                    </script>
                @endpush
                <div class="component cflex">
                    <div class="varient_preview" style="margin-inline: auto;padding-block:50px;">
                        {!! $varient['varient_html'] !!}
                    </div>
                    <h5>{{ $varient['varient_title'] }} <i class="text info"># {{ $component['component_title'] }}</i>
                    </h5>
                    <div class="rflex" style="margin-top: 15px;gap:10px">
                        <i class="fa-solid fa-edit icon vu-btn" title="Edit Base Component" style="--bg:var(--prime_rgb);"></i>
                        <i class="fa-solid fa-bug icon vu-btn" title="Mark error in varient" style="--bg:var(--error_rgb);"></i>
                        <i class="fa-solid fa-thumbs-up icon vu-btn" title="Approve  Varient" style="--bg:var(--success_rgb);"></i>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
