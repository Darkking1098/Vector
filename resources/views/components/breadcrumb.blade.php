@once
    @push('css')
        <style>
            .breadcrumb {
                padding: 20px 0;
                font-weight: 600;
                font-size: 0.9em;
            }

            .breadcrumb .breadcrumb-link {
                color: var(--prime);
                text-decoration: none;
            }

            .breadcrumb .breadcrumb-link::after {
                content: '/';
                padding: 0 5px;
            }
        </style>
    @endpush
@endonce
<div class="breadcrumb">
    <a href="{{ url('') }}" class="breadcrumb-link">Home</a>
    @for ($i = 0; $i < count($path) - 1; $i++)
        <a href="{{ $path[$i]['link'] }}" class="breadcrumb-link">
            {{ ucfirst($path[$i]['title']) }}
        </a>
    @endfor
    <span class="breadcrumb-stop">{{ ucfirst($path[count($path) - 1]['title']) }}</span>
</div>
