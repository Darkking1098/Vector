@php
    $path = [['title' => 'Vector Files', 'link' => url('vector')], ['title' => 'Customize Files', 'link' => url('vector/customize')], ['title' => 'Js']];
    $features = [['title' => 'vector', 'required' => true]];
@endphp
@extends('user.assets.layout')
@push('css')
    <style>
        .features_wrap {
            padding: 30px;
        }

        .features {
            margin-top: 20px;
        }

        label {
            font-size: 0.9em;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 10px 20px;
            display: inline-block;
            cursor: pointer;
        }

        label>* {
            cursor: pointer;
        }

        label.disabled {
            cursor: not-allowed;
            color: var(--gray_500);
        }

        label span {
            margin-left: 5px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }
    </style>
@endpush
@section('main')
    <main>
        <div class="page_details">
            <h1>Customize Vector Files</h1>
            <x-breadcrumb :path="$path"></x-breadcrumb>
        </div>
        <div class="features_wrap">
            <h3>Choose plugin's to use</h3>
            <div class="features">
                @foreach ($features as $i => $feature)
                    <div class="feature">
                        <label for="ip{{ $i }}" @class(['disabled' => $feature['required']])>
                            <input type="checkbox" name="{{ $feature['title'] }}" id="ip{{ $i }}"
                                @if ($feature['required']) disabled checked @endif>
                            <span>{{ ucfirst($feature['title']) }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
