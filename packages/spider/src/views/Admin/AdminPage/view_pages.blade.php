@extends('Spider::Admin.Assets.layout')
@push('css')
    <link rel="stylesheet" href="{{ url('vector/spider/css/admin/table.css') }}">
@endpush
@section('main')
    <main>
        <section class="table">
            <table class="vu-table head-stick">
                <thead>
                    <tr>
                        <td colspan="100%">
                            <input type="text" id="">
                        </td>
                    </tr>
                    <tr>
                        <th>Sr.</th>
                        <th>Page Title</th>
                        <th>Page Group</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $i => $page)
                        <tr @class(['disabled' => $page['page_status']])>
                            <td class="strong">{{ $i + 1 }}</td>
                            <td>{{ $page['page_title'] }}</td>
                            <td>{{ $page['admin_page_group']['page_group_title'] }}</td>
                            <td class="status">
                                <i class="badge prime bg-prime badge-success">Enabled</i>
                                <i class="badge error bg-error badge-error">Disabled</i>
                            </td>
                            <td class="actions">
                                <i class="icon fa-solid fa-edit"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="100%">
                            <div class="rflex jcsb">
                                <a href="" class="brand">
                                    <img src="{{ url('vector/spider/images/logo_full.png') }}" alt="">
                                </a>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
    </main>
@endsection
