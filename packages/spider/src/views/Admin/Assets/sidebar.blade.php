@php
    $cont = Vector\Spider\Http\Controllers\AdminControllers\AdminPageController::class;
    $groups = $cont::get_allowedPages();
@endphp
<div class="sidebar">
    <a href="{{ url('') }}" class="brand">
        <img src="{{ url('images/web assets/logo_white.png') }}" alt="">
    </a>
    <ul class="main_nav">
        <li @class(['group_head', 'active' => $current['current_slug'] == ''])>
            <a href="{{ url('/admin') }}" class="group_title">Dashboard</a>
        </li>
        @foreach ($groups as $group)
            @if (count($group['admin_pages']) > 0)
                <li @class([
                    'group_head',
                    'active' => $group['id'] == ($current['page_group'] ?? ''),
                ])>
                    <a class="group_title rflex jcsb aic">
                        {{ $group['page_group_title'] }}
                        <i class="fa-regular fa-angle-down"></i>
                    </a>
                    <ul>
                        @foreach ($group['admin_pages'] as $pg)
                            <li @class([
                                'active' => $pg['page_url'] == $current['current_slug'],
                            ])>
                                <a href="{{ url('/admin/' . $pg['page_url']) }}">
                                    {{ $pg['page_title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
    <ul class="sec_nav">
        <li class="logout"><a href="/admin/logout">Logout</a></li>
    </ul>
</div>
@push('js')
    <script>
        $(".group_head:has(ul)").VU.perform((n, i, no) => {
            console.log(n);
            let inner = n.$('ul')[0].VU;
            n.set("data-height", inner.node.offsetHeight + "px");
            n.$(".group_title")[0].addEventListener("click", () => {
                no.VU.perform((x) => {
                    if (n != x) {
                        x.removeClass("active")
                        x.$('ul')[0].VU.addCSS("height", "0px");
                    }
                })
                inner.addCSS("height", n.hasClass("active") ? "0px" : n.get("data-height"));
                n.toggleClass("active");
            })
            inner.addCSS("height", n.hasClass("active") ? n.get("data-height") : "0px");
        })
    </script>
@endpush
