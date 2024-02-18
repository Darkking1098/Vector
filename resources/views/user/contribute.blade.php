@php
    $path = [['title' => 'Contribute']];
@endphp
@extends('user.assets.layout')
@push('css')
    <style>
        a.vu-btn{
            margin-top: 30px
        }
    </style>
@endpush
@section('main')
    <main class="rflex aic jcc">
        <div class="thanks cflex aic" >
            <h3>Thanks buddy for your willingness.</h3>
            <h6 style="margin-top: 10px">We hope you have read <a href="{{url('conventions')}}">Naming Conventions</a> and <a href="{{url('conventions')}}">process to contribute</a></h6>
            <a href="{{url('admin')}}" class="vu-btn">Developer Panel</a>
        </div>
    </main>
@endsection
