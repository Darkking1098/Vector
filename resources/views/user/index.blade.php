@extends('user.assets.layout')
@push('css')
    <style>
        p {
            margin: 10px 0 30px;
        }

        a.vu-btn {
            transition: all 0.2s;
        }

        a.vu-btn.prime {
            background: var(--prime);
            color: white;
        }

        a.vu-btn:hover.prime {
            background: var(--prime_dark);
        }

        .btn.sec:hover {
            background: var(--gray_300);
        }

        .btn_group {
            margin-block: 10px 0;
        }
    </style>
@endpush
@section('main')
    <main class="cflex aic jcc">
        <h1>Welcome Buddy</h1>
        <p>Hey Developer, let's make something fantastic and grow this website</p>
        <div class="btn_group rflex" style="gap: 10px;">
            <a href="{{ url('conventions') }}" class="vu-btn sec">Naming Convention</a>
            <a href="{{ url('components') }}" class="vu-btn prime">Explore Components</a>
        </div>
        <div class="btn_group rflex" style="gap: 10px;">
            <a href="{{ url('contribute') }}" class="vu-btn sec">Contribute</a>
            <a href="{{ url('vector') }}" class="vu-btn sec">Vector Files</a>
        </div>
    </main>
@endsection
